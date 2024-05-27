@extends('admin::layouts.content')

@section('page_title')
    Modal banner
@stop

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

        {!! view_render_event('bagisto.admin.catalog.brands.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\ModalBannerDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.brands.list.before') !!}


    </div>
@stop
