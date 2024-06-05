@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.products.title') }}
@stop


@section('content')
    <div class="content" style="height: 100%;">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.products.title') }}</h1>
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

        <div class="row">
            <form method="GET" action="{{ route('admin.catalog.products.search') }}">
                <div class="control-group col-md-4">
                    <input type="text" name="query" class="control" placeholder="Gözle..."
                        value="{{ request()->input('query') }}" />
                    <button type="submit" class="btn btn-primary">
                        Gözleg
                    </button>
                </div>
            </form>
            {{-- <div class="control-group">
                <select name="" id="" class="control">
                    <option value="">Aşgabat</option>
                    <option value="">Awaza</option>
                </select>
            </div> --}}
        </div>

        <div class="page-content">
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Product number</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Price</th>
                        {{-- <th>Quantity</th> --}}
                        <th>Actions</th>
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
                                    <td>
                                        {{ $product->type }}
                                    </td>
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
                                        {!! $product->price !!}
                                    </td>
                                    {{-- <td>
                                        @if (is_null($product->quantity))
                                            0
                                        @else
                                            {{ $product->quantity }}
                                        @endif
                                    </td> --}}
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
                @if (!isset($query))
                    {!! $products->links() !!}
                @endif
            </div>
        </div>



        {{-- {!! view_render_event('bagisto.admin.catalog.products.list.before') !!}

        <div class="page-content">
            @inject('products', 'Webkul\Admin\DataGrids\ProductDataGrid')
            {!! $products->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.products.list.after') !!} --}}

    </div>

    {{-- <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal> --}}
@stop

@push('scripts')
    {{-- @include('admin::export.export', ['gridName' => $products]) --}}
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
