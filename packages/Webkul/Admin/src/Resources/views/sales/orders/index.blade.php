@extends('admin::layouts.content')
@section('head')
    <meta http-equiv="refresh" content="60">
@endsection
@section('page_title')
    {{ __('admin::app.sales.orders.title') }}
@stop

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

        <div class="page-content">
            @inject('orderGrid', 'Webkul\Admin\DataGrids\OrderDataGrid')
            {!! $orderGrid->render() !!}
        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

@stop

@push('scripts')
    @php
        $count = $orderGrid->getCollection()->where('status','pending')->count();
    @endphp
    @if($count))
        <script type="text/javascript">
            $(document).ready(function (e) {
                (new Audio("/mp3/notification.mp3")).play();

            });
            window.flashMessages = [{
                'type': 'alert-info',
                'message': {!! $count !!}+' taze sargyt bar!!!'
            }];
        </script>
    @endif
    @include('admin::export.export', ['gridName' => $orderGrid])

@endpush