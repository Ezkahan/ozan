<?php

namespace Webkul\Admin\Http\Controllers\Sales;

use Aws\IoTJobsDataPlane\IoTJobsDataPlaneClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Repositories\OrderRepository;
use \Webkul\Sales\Repositories\OrderCommentRepository;

use function JmesPath\search;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * OrderCommentRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderCommentRepository
     */
    protected $orderCommentRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\OrderCommentRepository  $orderCommentRepository
     * @return void
     */

    protected $inventorySourceId;
    public function __construct(
        OrderRepository $orderRepository,
        OrderCommentRepository $orderCommentRepository
    ) {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->orderRepository = $orderRepository;

        $this->orderCommentRepository = $orderCommentRepository;

        $this->inventorySourceId = auth('admin')->user()->inventory_source_id;
    }


    public function search(Request $request, Order $queryBuilder)
    {
        $location = ($this->inventorySourceId == null) ?  $request->input('location') : $this->inventorySourceId;
        $searchable = ($this->inventorySourceId == null) ? 1 : 0;
        $status = $request->input('status');
        $name = $request->input('search');

        // dd($location, $status);

        if ($status != null) {
            $queryBuilder = $queryBuilder->where('status', $status);
        }

        if ($location != null) {
            $queryBuilder = $queryBuilder->where('inventory_source_id', $location);
        }

        $queryBuilder = $queryBuilder->where(fn ($query) => $query
            ->where('customer_first_name', 'LIKE', "%$name%")
            ->orWhere('customer_last_name', 'LIKE', "%$name%"));

        $count = $queryBuilder->count();



        $orders = $queryBuilder->orderByDesc('created_at')->paginate(50);


        return view('admin::sales.orders.index', compact('orders', 'status', 'location', 'name', 'count', 'searchable'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $searchable = true;
        $orders = $this->orderRepository->orderByDesc('created_at')->paginate(50);
        $count = $orders->count();

        // dd(auth('admin')->user());
        if ($this->inventorySourceId != null) {
            $searchable = false;
            // dd($this->inventorySourceId);
            $orders = Order::where('inventory_source_id', '=', $this->inventorySourceId)->orderByDesc('created_at')->paginate(50);
            $count = Order::where('inventory_source_id', '=', $this->inventorySourceId)->count();
        }

        // dd($this->orderRepository->paginate(50));
        return view('admin::sales.orders.index', compact('orders', 'count', 'searchable'));
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $order = $this->orderRepository->findOrFail($id);

        return view($this->_config['view'], compact('order'));
    }

    /**
     * Cancel action for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $result = $this->orderRepository->cancel($id);

        if ($result) {
            session()->flash('success', trans('admin::app.response.cancel-success', ['name' => 'Order']));
        } else {
            session()->flash('error', trans('admin::app.response.cancel-error', ['name' => 'Order']));
        }

        return redirect()->back();
    }

    /**
     * Add comment to the order
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment($id)
    {
        $data = array_merge(request()->all(), [
            'order_id' => $id,
        ]);

        $data['customer_notified'] = isset($data['customer_notified']) ? 1 : 0;

        Event::dispatch('sales.order.comment.create.before', $data);

        $comment = $this->orderCommentRepository->create($data);

        Event::dispatch('sales.order.comment.create.after', $comment);

        session()->flash('success', trans('admin::app.sales.orders.comment-added-success'));

        return redirect()->back();
    }
}