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

        <div class="page-content">

            <tabs>
                {!! view_render_event('sales.order.tabs.before', ['order' => $order]) !!}

                <tab name="{{ __('admin::app.sales.orders.info') }}" :selected="true">
                    <div class="sale-container">

                        <accordian :title="'{{ __('admin::app.sales.orders.order-and-account') }}'" :active="true">
                            <div slot="body">

                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.order-info') }}</span>
                                    </div>

                                    <div class="section-content">
                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.order-date') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->created_at }}
                                            </span>
                                        </div>

                                        {!! view_render_event('sales.order.created_at.after', ['order' => $order]) !!}

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.order-status') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->status_label }}
                                            </span>
                                        </div>

                                        {!! view_render_event('sales.order.status_label.after', ['order' => $order]) !!}

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.channel') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->channel_name }}
                                            </span>
                                        </div>

                                        {!! view_render_event('sales.order.channel_name.after', ['order' => $order]) !!}
                                    </div>
                                </div>

                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.account-info') }}</span>
                                    </div>

                                    <div class="section-content">
                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.customer-name') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->customer_full_name }}
                                            </span>
                                        </div>

                                        {!! view_render_event('sales.order.customer_full_name.after', ['order' => $order]) !!}

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.email') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->customer_email }}
                                            </span>
                                        </div>

                                        {!! view_render_event('sales.order.customer_email.after', ['order' => $order]) !!}

                                        @if (! is_null($order->customer) && ! is_null($order->customer->group))
                                            <div class="row">
                                                <span class="title">
                                                    {{ __('admin::app.customers.customers.customer_group') }}
                                                </span>

                                                <span class="value">
                                                    {{ $order->customer->group->name }}
                                                </span>
                                            </div>
                                        @endif

                                        {!! view_render_event('sales.order.customer_group.after', ['order' => $order]) !!}
                                    </div>
                                </div>

                            </div>
                        </accordian>



                    </div>
                </tab>

                <tab name="{{ __('admin::app.sales.orders.invoices') }}">

                    <div class="table" style="padding: 20px 0">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{ __('admin::app.sales.invoices.id') }}</th>
                                    <th>{{ __('admin::app.sales.invoices.date') }}</th>
                                    <th>{{ __('admin::app.sales.invoices.order-id') }}</th>
                                    <th>{{ __('admin::app.sales.invoices.customer-name') }}</th>
                                    <th>{{ __('admin::app.sales.invoices.status') }}</th>
                                    <th>{{ __('admin::app.sales.invoices.amount') }}</th>
                                    <th>{{ __('admin::app.sales.invoices.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($order->invoices as $invoice)
                                    <tr>
                                        <td>#{{ $invoice->id }}</td>
                                        <td>{{ $invoice->created_at }}</td>
                                        <td>#{{ $invoice->order->increment_id }}</td>
                                        <td>{{ $invoice->address->name }}</td>
                                        <td>{{ $invoice->status_label }}</td>
                                        <td>{{ core()->formatBasePrice($invoice->base_grand_total) }}</td>
                                        <td class="action">
                                            <a href="{{ route('admin.sales.invoices.view', $invoice->id) }}">
                                                <i class="icon eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if (! $order->invoices->count())
                                    <tr>
                                        <td class="empty" colspan="7">{{ __('admin::app.common.no-result-found') }}</td>
                                    <tr>
                                @endif
                        </table>
                    </div>

                </tab>

                <tab name="{{ __('admin::app.sales.orders.shipments') }}">

                    <div class="table" style="padding: 20px 0">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{ __('admin::app.sales.shipments.id') }}</th>
                                    <th>{{ __('admin::app.sales.shipments.date') }}</th>
                                    <th>{{ __('admin::app.sales.shipments.carrier-title') }}</th>
                                    <th>{{ __('admin::app.sales.shipments.tracking-number') }}</th>
                                    <th>{{ __('admin::app.sales.shipments.total-qty') }}</th>
                                    <th>{{ __('admin::app.sales.shipments.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($order->shipments as $shipment)
                                    <tr>
                                        <td>#{{ $shipment->id }}</td>
                                        <td>{{ $shipment->created_at }}</td>
                                        <td>{{ $shipment->carrier_title }}</td>
                                        <td>{{ $shipment->track_number }}</td>
                                        <td>{{ $shipment->total_qty }}</td>
                                        <td class="action">
                                            <a href="{{ route('admin.sales.shipments.view', $shipment->id) }}">
                                                <i class="icon eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if (! $order->shipments->count())
                                    <tr>
                                        <td class="empty" colspan="7">{{ __('admin::app.common.no-result-found') }}</td>
                                    <tr>
                                @endif
                        </table>
                    </div>

                </tab>

                <tab name="{{ __('admin::app.sales.orders.refunds') }}">

                    <div class="table" style="padding: 20px 0">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{ __('admin::app.sales.refunds.id') }}</th>
                                    <th>{{ __('admin::app.sales.refunds.date') }}</th>
                                    <th>{{ __('admin::app.sales.refunds.order-id') }}</th>
                                    <th>{{ __('admin::app.sales.refunds.customer-name') }}</th>
                                    <th>{{ __('admin::app.sales.refunds.status') }}</th>
                                    <th>{{ __('admin::app.sales.refunds.refunded') }}</th>
                                    <th>{{ __('admin::app.sales.refunds.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($order->refunds as $refund)
                                    <tr>
                                        <td>#{{ $refund->id }}</td>
                                        <td>{{ $refund->created_at }}</td>
                                        <td>#{{ $refund->order->increment_id }}</td>
                                        <td>{{ $refund->order->customer_full_name }}</td>
                                        <td>{{ __('admin::app.sales.refunds.refunded') }}</td>
                                        <td>{{ core()->formatBasePrice($refund->base_grand_total) }}</td>
                                        <td class="action">
                                            <a href="{{ route('admin.sales.refunds.view', $refund->id) }}">
                                                <i class="icon eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if (! $order->refunds->count())
                                    <tr>
                                        <td class="empty" colspan="7">{{ __('admin::app.common.no-result-found') }}</td>
                                    <tr>
                                @endif
                        </table>
                    </div>

                </tab>

                {!! view_render_event('sales.order.tabs.after', ['order' => $order]) !!}
            </tabs>
        </div>

    </div>
@stop
