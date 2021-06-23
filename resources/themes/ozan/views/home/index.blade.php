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
    <section class="sectionBanner">
        <div class="auto__container">
            <div class="sectionBanner__inner">
                <picture>
                    <img src="images/banner/horizontal.png" alt="">
                </picture>
            </div>
        </div>
    </section>

    <!-- header start
    =========================================== -->
    <section class="sale">
        <div class="auto__container">
            <div class="sectionHeader">
                <div class="sectionHeader__title">
                    {{ __('shop::app.home.promotions') }}
                </div>
                {{-- <a href="#" class="sectionHeader__link">
                    <span>Посмотреть все</span>
                    <i class="icon-chevron-right"></i>
                </a> --}}
            </div>
            <div class="sale__inner">
                <div class="prev__s">
                    <i class="icon-chevron-left"></i>
                </div>
                <div class="next__s">
                    <i class="icon-chevron-right"></i>
                </div>
                <div class="sale__slider">
                    <div class="sale__slider-item">
                        <div class="sale__slider-item-title">
                            Приглашаем на фестиваль смартфонов
                        </div>
                        <div class="sale__slider-item-subtitle">
                            Акция недели
                        </div>
                        <div class="sale__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/sale/1.svg')}}" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="sale__slider-item">
                        <div class="sale__slider-item-title">
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
                        <div class="sale__slider-item-title">
                            Приглашаем на фестиваль смартфонов
                        </div>
                        <div class="sale__slider-item-subtitle">
                            Акция недели
                        </div>
                        <div class="sale__slider-item-image">
                            <picture>
                                <img src="images/sale/3.svg" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="sale__slider-item">
                        <div class="sale__slider-item-title">
                            Приглашаем на фестиваль смартфонов
                        </div>
                        <div class="sale__slider-item-subtitle">
                            Акция недели
                        </div>
                        <div class="sale__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/sale/1.svg')}}" alt="">
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
                    Бренды
                </div>
                <a href="#" class="sectionHeader__link">
                    <span>Посмотреть все</span>
                    <i class="icon-chevron-right"></i>
                </a>
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
                                <img src="{{bagisto_asset('images/brand/1 (1).png')}}" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="brand__slider-item">
                        <div class="brand__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/brand/1 (6).png')}}" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="brand__slider-item">
                        <div class="brand__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/brand/1 (5).png')}}" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="brand__slider-item">
                        <div class="brand__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/brand/1 (4).png')}}" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="brand__slider-item">
                        <div class="brand__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/brand/1 (3).png')}}" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="brand__slider-item">
                        <div class="brand__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/brand/1 (2).png')}}" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="brand__slider-item">
                        <div class="brand__slider-item-image">
                            <picture>
                                <img src="{{bagisto_asset('images/brand/1 (1).png')}}" alt="">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ view_render_event('bagisto.shop.home.content.after') }}

@endsection
