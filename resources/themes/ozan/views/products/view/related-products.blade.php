<?php
    $relatedProducts = $product->related_products()->get();
?>

@if ($relatedProducts->count())
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