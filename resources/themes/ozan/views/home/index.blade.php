@extends('shop::layouts.master')

@php
$channel = core()->getCurrentChannel();

$homeSEO = $channel->home_seo;

if (isset($homeSEO)) {
$homeSEO = json_decode($channel->home_seo);

$metaTitle = $homeSEO->meta_title;

$metaDescription = $homeSEO->meta_description;

$metaKeywords = $homeSEO->meta_keywords;
}

if($sliderData )
$reklamaSlider = $sliderData->where('title','reklama')->toArray();
@endphp

@section('page_title')
{{ isset($metaTitle) ? $metaTitle : "" }}
@endsection

@section('head')

@if (isset($homeSEO))
@isset($metaTitle)
<meta name="title" content="{{ $metaTitle }}" />
@endisset

@isset($metaDescription)
<meta name="description" content="{{ $metaDescription }}" />
@endisset

@isset($metaKeywords)
<meta name="keywords" content="{{ $metaKeywords }}" />
@endisset
@endif
@endsection

@section('content-wrapper')
{!! view_render_event('bagisto.shop.home.content.before') !!}


@include('shop::home.hero', ['sliderData' => $sliderData])
@include('shop::home.new-products')

<!-- product end
    =========================================== -->
@if($reklamaSlider)    
<section class="sectionBanner">
    <div class="auto__container">
        <div class="sectionBanner__inner">
            <div class="banner_box">
                <slider  :slides='@json($reklamaSlider)' public_path="{{ url()->to('/storage/') }}" time = '3000'></slider>

            </div>
        </div>
    </div>
</section>
@endif
<!-- header start
    =========================================== -->
<section class="sale">
    <div class="auto__container">
        <div class="sectionHeader">
            <div class="sectionHeader__title">
                {{ __('shop::app.home.promotions') }}
            </div>
        </div>
        <div class="sale__inner">

            <div class="sale__slider">

                <div class="sale__slider-item" style="box-sizing: unset;">
                    <div class="sale__slider-item-title" style="box-sizing: unset;">Приглашаем на фестиваль смартфонов
                    </div>
                    <div class="sale__slider-item-subtitle">Акция недели
                    </div>
                    <div class="sale__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/sale/1.svg')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="sale__slider-item">
                    <div class="sale__slider-item-title" style="box-sizing: unset;">
                        Вечерний образ
                    </div>
                    <div class="sale__slider-item-subtitle">
                        Акция недели
                    </div>
                    <div class="sale__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/sale/2.svg')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="sale__slider-item">
                    <div class="sale__slider-item-title" style="box-sizing: unset;">
                        Приглашаем на фестиваль смартфонов
                    </div>
                    <div class="sale__slider-item-subtitle">
                        Акция недели
                    </div>
                    <div class="sale__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/sale/3.svg')}}" alt="">
                        </picture>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- header end
    =========================================== -->
<!-- brand start
    =========================================== -->
<section class="brand">
    <div class="auto__container">
        <div class="sectionHeader">
            <div class="sectionHeader__title">
                {{__('shop::app.home.brands')}}
            </div>
            {{-- <a href="#" class="sectionHeader__link">
                    <span>Посмотреть все</span>
                    <i class="icon-chevron-right"></i>
                </a> --}}
        </div>
        <div class="brand__inner">
            <div class="prev__b">
                <i class="icon-chevron-left"></i>
            </div>
            <div class="next__b">
                <i class="icon-chevron-right"></i>
            </div>
            <div class="brand__slider">
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/arma.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/dat.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/ecil.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/han.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/han-coffee.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/han-sohlat.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/jos.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/ok.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/ozi.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/suytli-dere.png')}}" alt="">
                        </picture>
                    </div>
                </div>
                <div class="brand__slider-item">
                    <div class="brand__slider-item-image">
                        <picture>
                            <img src="{{bagisto_asset('images/brand/yeserje.png')}}" alt="">
                        </picture>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<section class="subscribe">
    <div class="subscribe__link">
        <i class="icon-telegram"></i>
        <span>Подписаться на наши новости и акции</span>
    </div>
</section>
{{ view_render_event('bagisto.shop.home.content.after') }}

@endsection