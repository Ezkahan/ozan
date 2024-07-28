@extends('admin::layouts.content')
@section('head')
    <meta http-equiv="refresh" content="60">
@endsection
@section('page_title')
    {{ __('admin::app.sales.orders.title') }}
@stop

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    tr {
        border-bottom: 1px solid #ddd;
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }
</style>


@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.sales.orders.title') }}</h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>
            </div>
        </div>
        <p>Jemi: {{ $count }} sany</p>

        <div class="">
            <form method="GET" action="{{ route('admin.sales.orders.search') }}">
                <div class="control-group" style="display: flex; flex-direction: row; align-items: center; width: 100%">
                    <div style="display: flex; align-items: center; width: 30%; margin-right: 15px;">
                        <input type="text" class="control" name="search" placeholder="Gözleg..." style="width: 100%"
                            @if (isset($name)) value="{{ $name }}" @endif>
                    </div>

                    @if ($searchable)
                        <div
                            style="display: flex; flex-direction: row; align-items: center; width: 30%; margin-right: 15px;">
                            <label for="" class="label-control" style="width: 20%;">Ýeri: </label>
                            <select name="location" id="" class="control" style="width: 80%; text-align: left;">
                                <option value="">Ählisi</option>
                                <option value="1" @if (isset($location) && $location == 1) selected @endif>Aşgabat</option>
                                <option value="2" @if (isset($location) && $location == 2) selected @endif>Awaza</option>
                            </select>
                        </div>
                    @endif
                    <div style="display: flex; flex-direction: row; align-items: center; width: 30%; margin-right: 15px;">
                        <label for="" class="label-control" style="width: 20%;">Status: </label>
                        <select name="status" id="" class="control" style="width: 80%;">
                            <option value="">Ählisi</option>
                            <option value="pending" @if (isset($status) && $status == 'pending') selected @endif>Pending</option>
                            <option value="pending_payment" @if (isset($status) && $status == 'pending_payment') selected @endif>Pending
                                payment
                            </option>
                            <option value="processing" @if (isset($status) && $status == 'processing') selected @endif>Processing
                            </option>
                            <option value="completed" @if (isset($status) && $status == 'completed') selected @endif>Completed
                            </option>
                            <option value="canceled" @if (isset($status) && $status == 'canceled') selected @endif>Canceled</option>
                            <option value="closed" @if (isset($status) && $status == 'closed') selected @endif>Closed</option>
                            <option value="fraud" @if (isset($status) && $status == 'fraud') selected @endif>Fraud</option>
                        </select>

                    </div>

                    <button type="submit" class="btn btn-lg btn-primary">
                        Gözleg
                    </button>

                </div>
            </form>
        </div>


        <div class="page-content">
            <div class="table-responsive">
                <table id="mytable" class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Sub Total</th>
                        <th>Grand Total</th>
                        <th>Order Date</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Shipped To</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ sprintf('%0.2f', $order->sub_total) . ' TMT' }}</td>
                                <td>{{ sprintf('%0.2f', $order->grand_total) . ' TMT' }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->payment->method }}</td>
                                <td>
                                    @if ($order->status == 'processing')
                                        <span class="badge badge-md badge-success">
                                            {{ trans('admin::app.sales.orders.order-status-processing') }}</span>
                                    @elseif ($order->status == 'completed')
                                        <span class="badge badge-md badge-success">
                                            {{ trans('admin::app.sales.orders.order-status-success') }} </span>
                                    @elseif ($order->status == 'canceled')
                                        <span class="badge badge-md badge-danger">
                                            {{ trans('admin::app.sales.orders.order-status-canceled') }} </span>
                                    @elseif ($order->status == 'closed')
                                        <span class="badge badge-md badge-info">
                                            {{ trans('admin::app.sales.orders.order-status-closed') }} </span>
                                    @elseif ($order->status == 'pending')
                                        <span class="badge badge-md badge-warning">
                                            {{ trans('admin::app.sales.orders.order-status-pending') }} </span>
                                    @elseif ($order->status == 'pending_payment')
                                        <span class="badge badge-md badge-warning">
                                            {{ trans('admin::app.sales.orders.order-status-pending-payment') }} </span>
                                    @elseif ($order->status == 'fraud')
                                        <span class="badge badge-md badge-danger">
                                            {{ trans('admin::app.sales.orders.order-status-fraud') }} </span>
                                    @endif
                                </td>
                                <td>
                                    @isset($order->shipping_address->first_name)
                                        {{ $order->shipping_address->first_name }}
                                    @endisset
                                    @isset($order->shipping_address->last_name)
                                        {{ $order->shipping_address->last_name }}
                                    @endisset
                                </td>
                                <td>
                                    <a href="{{ route('admin.sales.orders.view', $order->id) }}">
                                        <i class="icon eye-icon"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $orders->links() !!}
            </div>
        </div>

        {{-- <div class="page-content"> --}}
        {{-- {!! $orderGrid->render() !!} --}}
        {{-- </div> --}}
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

@stop
@inject('orderGrid', 'Webkul\Admin\DataGrids\OrderDataGrid')

@push('scripts')
    @php
        $count = $orders->getCollection()->where('status', 'pending')->count();
    @endphp
    @if ($count)
        <script type="text/javascript">
            $(document).ready(function(e) {
                (new Audio("/mp3/notification.mp3")).play();

            });
            window.flashMessages = [{
                'type': 'alert-info',
                'message': {!! $count !!} + ' taze sargyt bar!!!'
            }];
        </script>
    @endif
    @include('admin::export.export', ['gridName' => $orderGrid])
@endpush
