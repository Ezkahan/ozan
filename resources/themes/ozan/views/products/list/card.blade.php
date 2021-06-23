{!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}
@php
    $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
@endphp
<div class="card">

    <?php $productBaseImage = productimage()->getProductBaseImage($product); ?>

    @if ($product->new)
        {{-- <div class="sticker new">
            {{ __('shop::app.products.new') }}
        </div> --}}
    @endif
    
    @if ($showWishlist)
        @include('shop::products.wishlist')
    @endif

  
    <div class="card__image">
        <picture>
            <img src="{{ $productBaseImage['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'" alt="" />
        </picture>
    </div>
    <div class="card__body">
        @include ('shop::products.price', ['product' => $product])
        
        <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}" class="card__body-title">
            {{ $product->name }}
        </a>
        
    </div>

    {{-- <div class="product-information">

        <div class="product-name">
            <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
                <span>
                    {{ $product->name }}
                </span>
            </a>
        </div>

        @include ('shop::products.price', ['product' => $product])

        @include('shop::products.add-buttons', ['product' => $product])
    </div> --}}

</div>

{!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}