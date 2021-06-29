@extends('shop::layouts.master')

@section('page_title')
    {{ $page->page_title }}
@endsection

@section('seo')
    <meta name="title" content="{{ $page->meta_title }}" />

    <meta name="description" content="{{ $page->meta_description }}" />

    <meta name="keywords" content="{{ $page->meta_keywords }}" />
@endsection

@section('content-wrapper')
<div class="breadcumb">
    <div class="auto__container">
        <div class="breadcumb__inner">
            <a href="/">
                <span>{{__('shop::app.pagenames.homepage')}}</span>
                <i class="icon-chevron-right"></i>
            </a>
            <a href="#">{{$page->page_title}}</a>
        </div>
    </div>
</div>
<div class="auto__container">
    {!! DbView::make($page)->field('html_content')->render() !!}
</div>
@endsection