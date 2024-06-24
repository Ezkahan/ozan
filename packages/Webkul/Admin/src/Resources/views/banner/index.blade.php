@extends('admin::layouts.content')

@section('page_title')
    Modal banner
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
        border-bottom: 1px solid #ddd;
    }
</style>

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Modal banner</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('admin.banner.create') }}" class="btn btn-lg btn-primary">
                    Banner Goş
                </a>
            </div>
        </div>


        <div class="page-content">
            <div class="table-responsive">
                <table class="table table-stripped">
                    <thead>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>URL</th>
                        <th>Location</th>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->image }}</td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->description }}</td>
                                <td>{{ $banner->url }}</td>
                                <td>{{ $banner->location }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        {!! view_render_event('bagisto.admin.catalog.brands.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\ModalBannerDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.brands.list.before') !!}


    </div>
@stop
