<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/27/2021
 * Time: 21:09
 */

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Support\Facades\Log;
use Webkul\API\Http\Resources\Sales\Order;
use Webkul\Sales\Repositories\OrderRepository;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->guard = request()->has('token') ? 'api' : 'customer';

        Log::info(request()->url());
        Log::info(request());

        auth()->setDefaultDriver($this->guard);

        $this->middleware('auth:' . $this->guard);

        $this->orderRepository = $orderRepository;
    }

    public function index(){
        $query = $this->orderRepository->scopeQuery(function($query) {

            $query = $query->where('customer_id', auth()->user()->id );

            foreach (request()->except(['page', 'limit', 'pagination', 'sort', 'order', 'token','locale']) as $input => $value) {
                $query = $query->whereIn($input, array_map('trim', explode(',', $value)));
            }

            if ($sort = request()->input('sort')) {
                $query = $query->orderBy($sort, request()->input('order') ?? 'desc');
            } else {
                $query = $query->orderBy('id', 'desc');
            }

            return $query;
        });

        if (is_null(request()->input('pagination')) || request()->input('pagination')) {
            $results = $query->paginate(request()->input('limit') ?? 10);
        } else {
            $results = $query->get();
        }

        return Order::collection($results);
    }

    public function get($id)
    {
        return new Order($this->orderRepository->where('customer_id', auth()->user()->id)->findOrFail($id)->first());
    }

    /**
     * Cancel action for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $order = auth()->guard($this->guard)->user()->all_orders()->find($id);
        Log::info('cancel order',$order);
        try {

            if ($order && $this->repository->cancel($order))
                return response()->json([
                    'status'  => true,
                    'message' => __('admin::app.response.cancel-success', [
                        'name' => 'Order'
                    ]),
                ]);
            else
                return response()->json([
                    'status'  => false,
                    'message' => __('shop::app.common.error'),
                ]);

        }catch (\Exception $x){

            return response()->json([
                'status' => false,
                'message' => $x->getMessage()
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => trans($result?
                'admin::app.response.cancel-success' : 'admin::app.response.cancel-error',
                ['name' => 'Order']
            )
        ]);
    }

}