@extends('shop::layouts.master')
@inject ('productViewHelper', 'Webkul\Product\Helpers\View')
@section('page_title')
    {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
@stop
@php

    $productImages = [];
    $images = productimage()->getGalleryImages($product);

    foreach ($images as $key => $image) {
        array_push($productImages, $image['medium_image_url']);
    }
@endphp
@section('seo')
    <meta name="description" content="{{ trim($product->meta_description) != "" ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '') }}"/>

    <meta name="keywords" content="{{ $product->meta_keywords }}"/>

    @if (core()->getConfigData('catalog.rich_snippets.products.enable'))
        <script type="application/ld+json">
            {{ app('Webkul\Product\Helpers\SEO')->getProductJsonLd($product) }}
        </script>
    @endif

    <?php $productBaseImage = productimage()->getProductBaseImage($product); ?>

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:title" content="{{ $product->name }}" />

    <meta name="twitter:description" content="{!! htmlspecialchars(trim(strip_tags($product->description))) !!}" />

    <meta name="twitter:image:alt" content="" />

    <meta name="twitter:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:type" content="og:product" />

    <meta property="og:title" content="{{ $product->name }}" />

    <meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:description" content="{!! htmlspecialchars(trim(strip_tags($product->description))) !!}" />

    <meta property="og:url" content="{{ route('shop.productOrCategory.index', $product->url_key) }}" />
@stop

@section('content-wrapper')
<div class="auto__container">

    <section class="detail">
      
            <div class="detail__inner">
                @include ('shop::products.view.gallery')
                {{-- <form  class="detail__content"  method="POST" id="product-form" action="{{ route('cart.add', $product->product_id) }}" @click="onSubmit($event)"> --}}
                    <product-view>
                    @csrf
                    <h1 class="detail__content-title">
                        {!! $product->short_description !!}
                    </h1>
                    <div class="detail__content-brand">
                        <table>
                        @if ($customAttributeValues = $productViewHelper->getAdditionalData($product))
                        @foreach ($customAttributeValues as $attribute)
                        
                            @if ($attribute['label'])
                                <td>{{ $attribute['label'] }}:</td>
                            @else
                                <td>{{ $attribute['admin_name'] }}:</td>
                            @endif
                            @if ($attribute['type'] == 'file' && $attribute['value'])
                                <td>
                                    <a  href="{{ route('shop.product.file.download', [$product->product_id, $attribute['id']])}}">
                                        <i class="icon sort-down-icon download"></i>
                                    </a>
                                </td>
                            @elseif ($attribute['type'] == 'image' && $attribute['value'])
                                <td>
                                    <a href="{{ route('shop.product.file.download', [$product->product_id, $attribute['id']])}}">
                                        <img src="{{ Storage::url($attribute['value']) }}" style="height: 20px; width: 20px;" alt=""/>
                                    </a>
                                </td>
                            @else
                                <td>{{ $attribute['value'] }}</td>
                            @endif
                            
                        
                        @endforeach
                        @endif
                        </table>
                    </div>
                    @include ('shop::products.price', ['product' => $product])
                    @include ('shop::products.add-to-cart', [
                        'form' => false,
                        'product' => $product,
                        'showCartIcon' => false,
                        'showCompare' => core()->getConfigData('general.content.shop.compare_option') == "1"
                                        ? true : false,
                    ])
                    </product-view>
                    {{-- <div class="detail__content-color">
                        <div class="detail__content-color-title">
                            Цвет: Серый
                        </div>
                        <div class="detail__content-color-row">
                            <div class="detail__content-color-radio ">
                                <input checked type="radio" name="color" id="black">
                                <label class="color__label black" for="black"></label>
                            </div>
                            <div class="detail__content-color-radio">
                                <input type="radio" name="color" id="gray">
                                <label class="color__label gray" for="gray"></label>
                            </div>
                            <div class="detail__content-color-radio ">
                                <input type="radio" name="color" id="gold">
                                <label class="color__label gold" for="gold"></label>
                            </div>
                        </div>
                    </div>
                    <div class="detail__content-size">
                        <div class="detail__content-size-title">
                            Цвет: Серый
                        </div>
                        <div class="detail__content-size-row">
                            <div class="detail__content-size-radio">
                                <input checked type="radio" name="size" id="gb64">
                                <label class="size__label" for="gb64">
                                    64 GB
                                </label>
                            </div>
                            <div class="detail__content-size-radio">
                                <input type="radio" name="size" id="gb256">
                                <label class="size__label" for="gb256">
                                    256 GB
                                </label>
                            </div>
                        </div>
                    </div> --}}
                      
            
                   
                {{-- </form> --}}
            </div>
            <div class="detail__about">
                <h5>
                    {{ __('shop::app.products.description') }}:
                </h5>
                <p>
                    {!! $product->description !!}
                </p>
            </div>
            <!-- similar start
    =========================================== -->
            
            <!-- product end
    =========================================== -->
 
    </section>    
    @include ('shop::products.view.related-products')
</div>
    {{-- <section class="product-detail">

        <div class="layouter">
            <product-view>
                <div class="form-container">
                    @csrf()

                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                   

                    <div class="details">

                        <div class="product-heading">
                            <span>{{ $product->name }}</span>
                        </div>

                        @include ('shop::products.review', ['product' => $product])

                        @include ('shop::products.price', ['product' => $product])

                        @if (count($product->getTypeInstance()->getCustomerGroupPricingOffers()) > 0)
                            <div class="regular-price">
                                @foreach ($product->getTypeInstance()->getCustomerGroupPricingOffers() as $offers)
                                    <p> {{ $offers }} </p>
                                @endforeach
                            </div>
                        @endif

                        @include ('shop::products.view.stock', ['product' => $product])

                        {!! view_render_event('bagisto.shop.products.view.short_description.before', ['product' => $product]) !!}

                        <div class="description">
                            {!! $product->short_description !!}
                        </div>

                        {!! view_render_event('bagisto.shop.products.view.short_description.after', ['product' => $product]) !!}


                        {!! view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]) !!}

                        @if ($product->getTypeInstance()->showQuantityBox())
                            <quantity-changer></quantity-changer>
                        @else
                            <input type="hidden" name="quantity" value="1">
                        @endif

                        {!! view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]) !!}

                        @include ('shop::products.view.configurable-options')

                        @include ('shop::products.view.downloadable')

                        @include ('shop::products.view.grouped-products')

                        @include ('shop::products.view.bundle-options')

                        {!! view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]) !!}

                        <accordian :title="'{{ __('shop::app.products.description') }}'" :active="true">
                            <div slot="header">
                                {{ __('shop::app.products.description') }}
                                <i class="icon expand-icon right"></i>
                            </div>

                            <div slot="body">
                                <div class="full-description">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </accordian>

                        {!! view_render_event('bagisto.shop.products.view.description.after', ['product' => $product]) !!}

                        @include ('shop::products.view.attributes')

                        @include ('shop::products.view.reviews')
                    </div>
                </div>
            </product-view>
        </div>

      

        @include ('shop::products.view.up-sells')

    </section> --}}

    {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}
@endsection

@push('scripts')
    <script type='text/javascript' src='https://unpkg.com/spritespin@4.1.0/release/spritespin.js'></script>

    <script type="text/x-template" id="product-view-template">
        <form
            method="POST"
            id="product-form"
            @click="onSubmit($event)"
            action="{{ route('cart.add', $product->product_id) }}">

            <input type="hidden" name="is_buy_now" v-model="is_buy_now">

            <slot v-if="slot"></slot>

            <div v-else>
                <div class="spritespin"></div>
            </div>

        </form>
    </script>

    <script>
        Vue.component('product-view', {
            inject: ['$validator'],
            template: '#product-view-template',
            data: function () {
                return {
                    slot: true,
                    is_buy_now: 0,
                }
            },

            mounted: function () {
                let currentProductId = '{{ $product->url_key }}';
                let existingViewed = window.localStorage.getItem('recentlyViewed');

                if (! existingViewed) {
                    existingViewed = [];
                } else {
                    existingViewed = JSON.parse(existingViewed);
                }

                if (existingViewed.indexOf(currentProductId) == -1) {
                    existingViewed.push(currentProductId);

                    if (existingViewed.length > 3)
                        existingViewed = existingViewed.slice(Math.max(existingViewed.length - 4, 1));

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(existingViewed));
                } else {
                    var uniqueNames = [];

                    $.each(existingViewed, function(i, el){
                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                    });

                    uniqueNames.push(currentProductId);

                    uniqueNames.splice(uniqueNames.indexOf(currentProductId), 1);

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(uniqueNames));
                }
            },

            methods: {
                onSubmit: function(event) {
                    if (event.target.getAttribute('type') != 'submit')
                        return;

                    event.preventDefault();

                    this.$validator.validateAll().then(result => {
                        if (result) {
                            this.is_buy_now = event.target.classList.contains('buynow') ? 1 : 0;

                            setTimeout(function() {
                                document.getElementById('product-form').submit();
                            }, 0);
                        }
                    });
                },
            }
        });

        window.onload = function() {
            var thumbList = document.getElementsByClassName('thumb-list')[0];
            var thumbFrame = document.getElementsByClassName('thumb-frame');
            var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

            if (thumbList && productHeroImage) {
                for (let i=0; i < thumbFrame.length ; i++) {
                    thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                    thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                }

                if (screen.width > 720) {
                    thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.height = productHeroImage.offsetHeight + "px";
                }
            }

            window.onresize = function() {
                if (thumbList && productHeroImage) {

                    for(let i=0; i < thumbFrame.length; i++) {
                        thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                        thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                    }

                    if (screen.width > 720) {
                        thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.height = productHeroImage.offsetHeight + "px";
                    }
                }
            }
        };
    </script>
@endpush