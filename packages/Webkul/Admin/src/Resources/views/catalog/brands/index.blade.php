@extends('admin::layouts.content')

@section('page_title')
    Brendler
@stop

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
            {!! app('Webkul\Admin\DataGrids\BrandDataGrid')->render() !!}
        </div>

    </div>
@stop
