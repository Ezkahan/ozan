@extends('shop::layouts.master')

@section('page_title')

@endsection

@section('head')

        <meta name="title" content="{{__('app.our-brands')}}" />

        <meta name="description" content="Ozan {{__('app.our-brands')}}" />

        <meta name="keywords" content="{{$brands->implode('admin_name',', ')}}" />

@endsection

@section('content-wrapper')
    <div class="auto__container p-5 my_wrap">
        @foreach($brands as $brand)
        <div tabindex="-1" role="tabpanel" class="VueCarousel-slide VueCarousel-slide-active">
            <div class="card grid-card product-card-new">
                <a href="#" title="{{$brand->admin_name}}" class="product-image-container">
                    <img loading="lazy" alt="{{$brand->admin_name}}"
                         src="{{$brand->swatch_value_url}}"
                         data-src="{{$brand->swatch_value_url}}"
                         onerror="this.src='https://ozan.com.tm/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'" class="card-img-top lzy_img">
                </a>
                {{--<div class="card-body"><div class="product-name col-12 no-padding">--}}
                        {{--<a title="{{$brand->admin_name}}" href="https://ozan.com.tm/j200000103" class="unset">--}}
                            {{--<span class="fs16">{{$brand->admin_name}}</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        @endforeach
    </div>
@endsection