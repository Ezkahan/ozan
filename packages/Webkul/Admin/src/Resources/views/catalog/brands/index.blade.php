@extends('admin::layouts.content')

@section('page_title')
    Brendler
@stop
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    tr {
        border-bottom: 1px solid #ddd;
    }

    th {
        text-align: left;
    }
</style>

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Brendler</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('admin.catalog.brands.create') }}" class="btn btn-lg btn-primary">
                    Brend Döret
                </a>
            </div>
        </div>


        <div class="page-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Swatch</th>
                        <th>ID</th>
                        <th>Ady</th>
                        <th>TM terjime</th>
                        <th>EN terjime</th>
                        <th>RU terjime</th>
                        <th>Position</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td><img src="{{ asset('storage/' . $brand->swatch_value) }}" alt="" width="50"
                                        height="50"></td>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->admin_name }}</td>
                                <td>{{ $brand->getTranslation('tm')->label }}</td>
                                <td>
                                    @isset($brand->getTranslation('en')->label)
                                        {{ $brand->getTranslation('en')->label }}
                                    @endisset
                                </td>
                                <td>{{ $brand->getTranslation('ru')->label }}</td>
                                <td>{{ $brand->sort_order }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $brands->links() !!}
            </div>
        </div>


        {{-- {!! view_render_event('bagisto.admin.catalog.brands.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\BrandDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.brands.list.before') !!} --}}


    </div>
@stop
