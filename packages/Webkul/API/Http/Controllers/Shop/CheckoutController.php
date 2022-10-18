<?php

namespace Webkul\API\Http\Controllers\Shop;

use Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Webkul\Payment\Facades\Payment;
use Webkul\Sales\Repositories\OrderCommentRepository;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Checkout\Repositories\CartRepository;
use Webkul\Shop\Http\Controllers\OnepageController;
use Webkul\Checkout\Repositories\CartItemRepository;
use Webkul\Checkout\Http\Requests\CustomerAddressForm;
use Webkul\API\Http\Resources\Sales\Order as OrderResource;
use Webkul\API\Http\Resources\Checkout\Cart as CartResource;
use Webkul\API\Http\Resources\Checkout\CartShippingRate as CartShippingRateResource;
use Webkul\API\Http\Resources\Customer\CustomerAddress as CustomerAddressResource;

class CheckoutController extends Controller
{
    /**
     * Contains current guard
     *
     * @var array
     */
    protected $guard;

    /**
     * CartRepository object
     *
     * @var \Webkul\Checkout\Repositories\CartRepository
     */
    protected $cartRepository;

    /**
     * CartItemRepository object
     *
     * @var \Webkul\Checkout\Repositories\CartItemRepository
     */
    protected $cartItemRepository;
    protected $commentRepository;
    /**
     * Controller instance
     *
     * @param  \Webkul\Checkout\Repositories\CartRepository  $cartRepository
     * @param  \Webkul\Checkout\Repositories\CartItemRepository  $cartItemRepository
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     */
    public function __construct(
        CartRepository $cartRepository,
        CartItemRepository $cartItemRepository,
        OrderRepository $orderRepository,
        OrderCommentRepository $commentRepository
    )
    {
        $this->guard = request()->has('token') ? 'api' : 'customer';

        auth()->setDefaultDriver($this->guard);

        // $this->middleware('auth:' . $this->guard);

        $this->_config = request('_config');

        $this->cartRepository = $cartRepository;

        $this->cartItemRepository = $cartItemRepository;

        $this->orderRepository = $orderRepository;

        $this->commentRepository = $commentRepository;

    }

    /**
     * Saves customer address.
     *
     * @param  \Webkul\Checkout\Http\Requests\CustomerAddressForm $request
     * @return \Illuminate\Http\Response
    */
    public function saveAddress(CustomerAddressForm $request)
    {

        $data = request()->all();

        $data['billing']['address1'] = implode(PHP_EOL, array_filter($data['billing']['address1']));

        $data['shipping']['address1'] = implode(PHP_EOL, array_filter($data['shipping']['address1']));

        if (isset($data['billing']['id']) && str_contains($data['billing']['id'], 'address_')) {
            unset($data['billing']['id']);
            unset($data['billing']['address_id']);
        }

        if (isset($data['shipping']['id']) && Str::contains($data['shipping']['id'], 'address_')) {
            unset($data['shipping']['id']);
            unset($data['shipping']['address_id']);
        }

        if(!isset($data['shipping']['address_id']))
            return response()->json([
                'error' => 'shipping address id is required'
            ],400);


        if (Cart::hasError() || ! Cart::saveCustomerAddress($data) || ! Shipping::collectRates()) {

            return response()->json([
                'success' => false,
                'message' => 'Korzina usarel. Pozhaluysta obnavite korzinu'

            ]);
        }

        $rates = [];

        foreach (Shipping::getGroupedAllShippingRates() as $code => $shippingMethod) {
            $rates[] = [
                'carrier_title' => $shippingMethod['carrier_title'],
                'rates'         => CartShippingRateResource::collection(collect($shippingMethod['rates'])),
            ];
        }

        Cart::collectTotals();

        return response()->json([
            'data' => [
                'rates' => $rates,
                'methods' => Payment::getPaymentMethods(),
                'cart'  => new CartResource(Cart::getCart()),
            ]
        ],400);
    }

    /**
     * Saves shipping method.
     *
     * @return \Illuminate\Http\Response
    */
    public function saveShipping()
    {
        $shippingMethod = request()->get('shipping_method');

        if (Cart::hasError()
            || !$shippingMethod
            || ! Cart::saveShippingMethod($shippingMethod)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Korzina ustarel. Pozhaluysta obnavite korzinu'

            ],400);
        }

        Cart::collectTotals();

        return response()->json([
            'data' => [
                'methods' => Payment::getPaymentMethods(),
                'cart'    => new CartResource(Cart::getCart()),
            ]
        ]);
    }

    /**
     * Saves payment method.
     *
     * @return \Illuminate\Http\Response
    */
    public function savePayment()
    {
        $payment = request()->get('payment');

        if (Cart::hasError() || ! $payment || ! Cart::savePaymentMethod($payment)) {
            return response()->json([
                'success' => false,
                'message' => 'Korzina ustarel. Pozhaluysta obnavite korzinu'

            ],400);
        }

        return response()->json([
            'data' => [
                'cart' => new CartResource(Cart::getCart()),
            ]
        ]);
    }

    /**
     * Check for minimum order.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkMinimumOrder()
    {
        $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;

        $status = Cart::checkMinimumOrder();

        return response()->json([
            'status' => ! $status ? false : true,
            'message' => ! $status ? trans('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) : 'Success',
//            'data' => [
//                'cart'   => new CartResource($cart),
//            ]
        ]);
    }

    /**
     * Saves order.
     *
     * @return \Illuminate\Http\Response
    */
    public function saveOrder()
    {
        if (Cart::hasError()) {
            return response()->json([
                'success' => false,
                'message' => 'Korzina ustarel. Pozhaluysta obnavite korzinu'

            ],400);
        }

        Cart::collectTotals();

        try {
            app(OnepageController::class)->validateOrder();
        }
        catch (Exception $ex){
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()

            ]);
        }

        $cart = Cart::getCart();

        if ($redirectUrl = Payment::getRedirectUrl($cart)) {

            try{
                $payment_method = Payment::getPaymentMethod($cart);
                $result =  json_decode($payment_method->registerOrder(),true);

                if($result['response']['operationResult'] == 'OPG-00100' && $orderId = $result['response']['orderId']){
//                dd($result);
                    $payment_method->registerOrderId($orderId);
                    return response()->json(['status' => true, 'redirect_url' => $result['_links']['redirectToCheckout']['href']]);
                }
                else{//if already registered or otkazana w dostupe

                    return response()->json([
                        'success' => false,
                        'message' => $result['response']['operationResultDescription']
                    ]);

                }

            }catch (\Exception $exception){
                Log::error($exception);
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ]);
            }

        }

        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        if(request()->has('comment')){
            $this->commentRepository->create(['order_id' => $order->id,'comment' =>request('comment')]);
        }
        Cart::deActivateCart();

        return response()->json([
            'success' => true,
            'order'   => new OrderResource($order),
        ]);
    }

    /**
     * Validate order before creation
     *
     * @throws Exception
     */
    public function validateOrder()
    {
        app(OnepageController::class)->validateOrder();
    }


    public function checkout() {

        $data = request()->all();

        $data['address']['billing']['address1'] = implode(PHP_EOL, array_filter($data['address']['billing']['address1']));

        $data['address']['shipping']['address1'] = implode(PHP_EOL, array_filter($data['address']['shipping']['address1']));

        if (isset($data['address']['billing']['id']) && str_contains($data['address']['billing']['id'], 'address_')) {
            unset($data['address']['billing']['id']);
            unset($data['address']['billing']['address_id']);
        }

        if (isset($data['address']['shipping']['id']) && Str::contains($data['address']['shipping']['id'], 'address_')) {
            unset($data['address']['shipping']['id']);
            unset($data['address']['shipping']['address_id']);
        }

        if(!isset($data['address']['shipping']['address_id']))
            return response()->json([
                'error' => 'shipping address id is required'
            ],400);



        // DB::beginTransaction();
        // try {
            // Start Save Address
            if (Cart::hasError() || ! Cart::saveCustomerAddress($data['address']) || ! Shipping::collectRates()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Korzina usarel. Pozhaluysta obnavite korzinu'

                ]);
            }
            // End Save Address

            // Start Save Shipping

            $shippingMethod = $data['shipping_method'];

            if (Cart::hasError() || !$shippingMethod || ! Cart::saveShippingMethod($shippingMethod)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Korzina ustarel. Pozhaluysta obnavite korzinu'

                ],400);
            }

            Cart::collectTotals();

            // End Save Shipping

            // Start Save Payment

            $payment = $data['payment'];

            if (Cart::hasError() || ! $payment || ! Cart::savePaymentMethod($payment)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Korzina ustarel. Pozhaluysta obnavite korzinu'

                ],400);
            }
            // End Save Payment

            // Start Check Cupon

            $couponCode = '';
        if (array_key_exists('code', $data)) {
            $couponCode = $data['code'];
        }
            if (strlen($couponCode)) {
                Cart::setCouponCode($couponCode)->collectTotals();
                if (Cart::getCart()->coupon_code != $couponCode) {
                    return response()->json([
                        'success' => false,
                        'message' => trans('shop::app.checkout.total.invalid-coupon'),
                    ]);
                }
            }
            // End Check Cupon

            $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;

            $status = Cart::checkMinimumOrder();

            if (Cart::hasError()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Korzina ustarel. Pozhaluysta obnavite korzinu'

                ],400);
            }

            Cart::collectTotals();

            try {
                app(OnepageController::class)->validateOrder();
            }
            catch (Exception $ex){
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()

                ]);
            }

            $cart = Cart::getCart();

            if ($redirectUrl = Payment::getRedirectUrl($cart)) {

                try{
                    $payment_method = Payment::getPaymentMethod($cart);
                    $result =  json_decode($payment_method->registerOrder(),true);

                    if($result['response']['operationResult'] == 'OPG-00100' && $orderId = $result['response']['orderId']){
//                    dd($result);
                        $payment_method->registerOrderId($orderId);
                        return response()->json(['status' => true, 'redirect_url' => $result['_links']['redirectToCheckout']['href']]);
                    }
                    else{//if already registered or otkazana w dostupe

                        return response()->json([
                            'success' => false,
                            'message' => $result['response']['operationResultDescription']
                        ]);

                    }

                }catch (\Exception $exception){
                    Log::error($exception);
                    return response()->json([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ]);
                }

            }

            $order = $this->orderRepository->create(Cart::prepareDataForOrder());

            if(request()->has('comment')){
                $this->commentRepository->create(['order_id' => $order->id,'comment' =>request('comment')]);
            }
            Cart::deActivateCart();

            return response()->json([
                'success' => true,
                'order'   => new OrderResource($order),
            ]);
  
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     throw $e;
        // }
    }

    public function method(){

        $customer = auth($this->guard)->user();

        $addresses = $customer->addresses()->get();

        Shipping::collectRates();

        $rates = [];

        foreach (Shipping::getGroupedAllShippingRates() as $code => $shippingMethod) {
            $rates[] = [
                'carrier_title' => $shippingMethod['carrier_title'],
                'rates'         => CartShippingRateResource::collection(collect($shippingMethod['rates'])),
            ];
        }


        return response()->json([
            'data' => [
                "addresses" =>  CustomerAddressResource::collection($addresses),
                'shippingMethods' => $rates,
                'paymetMethods' => Payment::getPaymentMethods(),
                'cart'    => new CartResource(Cart::getCart()),
            ]
        ]);
    }
}