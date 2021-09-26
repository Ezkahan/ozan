<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/24/2021
 * Time: 17:16
 */

namespace Payment\Http\Controllers;
use GuzzleHttp\Exception\ConnectException;
use Webkul\Checkout\Facades\Cart;
use Payment\CardPayment\TFEB;
use Webkul\Sales\Repositories\OrderRepository;


class TFEBController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $orderRepository;

    /**
     * @var AltynAsyr object
     */
    protected $teb;

    public function __construct(OrderRepository $orderRepository, TFEB $teb)
    {
        $this->orderRepository = $orderRepository;
        $this->teb = $teb;
    }

    /**
     * Redirects to payment gateway
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(){
        // register order to payment gateway
        try{
            $result =  $this->teb->registerOrder();
            if($result['response']['operationResult'] == 'OPG-00100' && $orderId = $result['response']['orderId']){
//                dd($result);
                $this->teb->registerOrderId($orderId);
                return redirect($result[$result['_links']['redirectToCheckout']['href']]);
            }
            else{//if already registered or otkazana w dostupe
                //todo log
                session()->flash('error', $result['errorMessage']);
            }

        }catch (\Exception $exception){
            //todo Check exception if not connection excepion redirect to login ore somewhere if session expired
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success(){
        try {
            $result = $this->teb->getOrderStatus();

            if ($result['Response']['OperationResult'] == 'GEN-00000') {
                $order = $this->orderRepository->create(Cart::prepareDataForOrder());
                //todo save card details to cart->payment
                Cart::deActivateCart();

                session()->flash('order', $order);

                return redirect()->route('shop.checkout.success');

            } else {
                session()->flash('error', trans('payment.unsuccessfull'));
            }
        }
        catch (ConnectException $connectException){
            session()->flash('error',trans('payment::messages.connection_failed'));
        }
        catch (\Exception $exception){
            session()->flash('error',trans('payment::messages.session_expired'));
        }
        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Cancel payment from gateway
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(){
        session()->flash('error', trans('payment::messages.unsuccessfull'));

        return redirect()->route('shop.checkout.cart.index');
    }

    public function status(){

        return view('payment::order-status');
    }
}