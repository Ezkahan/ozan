<?php
    $relatedProducts = $product->related_products()->get();
?>

@if ($relatedProducts->count())
    <div class="attached-products-wrapper">

        <div class="title">
            {{ __('shop::app.products.related-product-title') }}
            <span class="border-bottom"></span>
        </div>

        <div class="product-grid-4">

            @foreach ($relatedProducts as $related_product)

                @include ('shop::products.list.card', ['product' => $related_product])

            @endforeach

        </div>

    </div>
    <section class="product">
        <div class="sectionHeader">
            <div class="sectionHeader__title">
                {{ __('shop::app.products.related-product-title') }}
            </div>
            {{-- <a href="#" class="sectionHeader__link">
                <span>Посмотреть все</span>
                <i class="icon-chevron-right"></i>
            </a> --}}
        </div>
        <div class="product__row">
            @foreach ($relatedProducts as $related_product)

            @include ('shop::products.list.card', ['product' => $related_product])

            @endforeach
        </div>
    </section>
@endif