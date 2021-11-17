@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.sales.orders.view-title', ['order_id' => $order->increment_id]) }}
@stop

@section('content-wrapper')

    <div class="content full-page">

        <div class="page-header">

            <div class="page-title">
                <h1>
                    {!! view_render_event('sales.order.title.before', ['order' => $order]) !!}

                    <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.sales.orders.index') }}'"></i>

                    {{ __('admin::app.sales.orders.view-title', ['order_id' => $order->increment_id]) }}

                    {!! view_render_event('sales.order.title.after', ['order' => $order]) !!}
                </h1>
            </div>

            <div class="page-action">
                {!! view_render_event('sales.order.page_action.before', ['order' => $order]) !!}

                @if ($order->canCancel() && bouncer()->hasPermission('sales.orders.cancel'))
                    <a href="{{ route('admin.sales.orders.cancel', $order->id) }}" class="btn btn-lg btn-primary" v-alert:message="'{{ __('admin::app.sales.orders.cancel-confirm-msg') }}'">
                        {{ __('admin::app.sales.orders.cancel-btn-title') }}
                    </a>
                @endif

                @if ($order->canInvoice())
                    <a href="{{ route('admin.sales.invoices.create', $order->id) }}" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.orders.invoice-btn-title') }}
                    </a>
                @endif

                @if ($order->canRefund())
                    <a href="{{ route('admin.sales.refunds.create', $order->id) }}" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.orders.refund-btn-title') }}
                    </a>
                @endif

                @if ($order->canShip())
                    <a href="{{ route('admin.sales.shipments.create', $order->id) }}" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.orders.shipment-btn-title') }}
                    </a>
                @endif

                {!! view_render_event('sales.order.page_action.after', ['order' => $order]) !!}
            </div>
        </div>



    </div>
@stop
