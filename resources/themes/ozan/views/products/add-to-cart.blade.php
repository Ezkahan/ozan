
@php
    $width = (core()->getConfigData('catalog.products.storefront.buy_now_button_display') == 1) ? '49' : '95';
@endphp

<button type="submit" class="detail__content-submit addtocart" {{ ! $product->isSaleable() ? 'disabled' : '' }}
style="width: <?php echo $width.'%';?>;">
    {{ ($product->type == 'booking') ?  __('shop::app.products.book-now') :  __('shop::app.products.add-to-cart') }}
</button>

