@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.products.title') }}
@stop
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    tr {
        border-bottom: 1px solid #ddd;
    }
</style>

@section('content')
    <div class="content" style="height: 100%;">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.products.title') }}</h1>
                <p>Jemi: {{ $products_count }} önüm</p>
            </div>

            <div class="page-action row">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>

                <a href="{{ route('admin.catalog.products.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.catalog.products.add-product-btn-title') }}
                </a>
            </div>
        </div>

        <div class="">
            <form method="GET" action="{{ route('admin.catalog.products.search') }}">
                <div class="control-group d-inline-flex flex-row">

                    <input type="text" name="query" class="control" placeholder="Gözle..." style="width: 20%;"
                        value="{{ request()->input('query') }}" />

                    <select name="location" id="" class="control" style="width: 20%;">
                        <option value="">Ählisi</option>
                        <option value="1" @if (isset($location) && $location == 1) selected @endif>Aşgabat</option>
                        <option value="2" @if (isset($location) && $location == 2) selected @endif>Awaza</option>
                    </select>

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
                        <th style="text-align: left; border-bottom: 1px solid #ddd;">ID</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd; ">SKU</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd;">Product number</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd; width: 33%;">Name</th>
                        {{-- <th style="text-align: left; border-bottom: 1px solid #ddd;">Type</th> --}}
                        <th style="text-align: left; border-bottom: 1px solid #ddd;">Status</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd;">Price</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd;">Aşgabat</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd;">Awaza</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
                    </thead>
                    <tbody>
                        @if (isset($products))
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        {{ $product->sku }}
                                    </td>
                                    <td>
                                        {{ $product->product_number }}
                                    </td>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    {{-- <td>
                                        {{ $product->type }}
                                    </td> --}}
                                    <td>
                                        <p>
                                            @if ($product->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </p>

                                    </td>
                                    <td>
                                        @foreach ($product->inventories as $inventory)
                                            @if ($inventory->inventory_source_id == 1)
                                                {{ 'Aşgabat: ' }}
                                            @else
                                                {{ 'Awaza: ' }}
                                            @endif
                                            {{ sprintf('%0.2f', $inventory->sale_price) . ' TMT' }}
                                            <br>
                                        @endforeach
                                    </td>
                                    {{-- <td>{{ $product->inventories }}</td> --}}
                                    @if ($product->inventories->count() == 2)
                                        @if ($product->inventories[0]->inventory_source_id == 1)
                                            <td>{{ $product->inventories[0]->qty }}</td>
                                            <td>{{ $product->inventories[1]->qty }}</td>
                                        @else
                                            <td>{{ $product->inventories[1]->qty }}</td>
                                            <td>{{ $product->inventories[0]->qty }}</td>
                                        @endif
                                    @else
                                        @if ($product->inventories[0]->inventory_source_id == 1)
                                            <td>{{ $product->inventories[0]->qty }}</td>
                                            <td>0</td>
                                        @else
                                            <td>0</td>
                                            <td>{{ $product->inventories[0]->qty }}</td>
                                        @endif
                                    @endif
                                    <td class="row">
                                        <a href="{{ route('admin.catalog.products.edit', $product->id) }}">
                                            <i class="icon pencil-lg-icon"></i>
                                        </a>

                                        <form action="{{ route('admin.catalog.products.delete', $product->id) }}"
                                            method="POST" onsubmit="return confirmDelete()">
                                            @csrf
                                            <button type="submit" class="btn">
                                                <i class="icon trash-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @endif
                    </tbody>
                </table>
                {!! $products->links() !!}
            </div>
        </div>



        {{-- {!! view_render_event('bagisto.admin.catalog.products.list.before') !!}

        <div class="page-content">
            @inject('products', 'Webkul\Admin\DataGrids\ProductDataGrid')
            {!! $products->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.products.list.after') !!} --}}

    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>
@stop

@push('scripts')
    @include('admin::export.export', ['gridName' => $products])
    <script>
        function reloadPage(getVar, getVal) {
            let url = new URL(window.location.href);
            url.searchParams.set(getVar, getVal);

            window.location.href = url.href;
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#mytable #checkall").click(function() {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function() {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function() {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("[data-toggle=tooltip]").tooltip();
        });
    </script>

    <script type="text/javascript">
        function confirmDelete() {
            return confirm('Bu önümi pozmak isleýäňizmi?');
        }
    </script>
@endpush
