@extends('shop::layouts.master')

@section('page_title')

@endsection

@section('head')

        <meta name="title" content="{{__('app.our-brands')}}" />

        <meta name="description" content="Ozan {{__('app.our-brands')}}" />

        <meta name="keywords" content="{{$shops->implode('admin_name',', ')}}" />

@endsection

@section('content-wrapper')
    <div class="auto__container">
        <div class="my_wrap my_brands pt-3">
            @foreach($shops as $shop)
                <div class="card grid-card product-card-new my_brands_item m-lg-3 m-xl-2 m-md-3 m-1">
                    <a href="{{route('velocity.search.index',['shops'=>$shop->id])}}" title="{{$shop->admin_name}}" class="product-image-container">
                        <img loading="lazy" alt="{{$shop->admin_name}}"
                             src="{{$shop->swatch_value_url}}"
                             data-src="{{$shop->swatch_value_url}}"
                             onerror="this.src='https://ozan.com.tm/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'" class="card-img-top lzy_img">
                    </a>

                </div>
            @endforeach
        </div>

        <div class="bottom-toolbar">{!! $shops->onEachSide(1)->links()->toHtml() !!}</div>
    </div>
@endsection