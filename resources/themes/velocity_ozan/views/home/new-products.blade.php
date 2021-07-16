@php
    $count = core()->getConfigData('catalog.products.homepage.no_of_new_product_homepage');
    $count = $count ? $count : 10;
    $direction = core()->getCurrentLocale()->direction == 'rtl' ? 'rtl' : 'ltr';
@endphp

{!! view_render_event('bagisto.shop.new-products.before') !!}

<product-collections
    :show-recently-viewed="false"
    :count="{{ (int) $count }}"

    product-id="new-products-carousel"
    product-title="{{ __('shop::app.home.new-products') }}"
    product-route="{{ route('velocity.category.details', ['category-slug' => 'new-products', 'count' => $count]) }}"
    locale-direction="{{ $direction }}"
    recently-viewed-title="{{ __('velocity::app.products.recently-viewed') }}"
    no-data-text="{{ __('velocity::app.products.not-available') }}">
</product-collections>

{!! view_render_event('bagisto.shop.new-products.after') !!}

<div class="social-icons col-lg-6">
    <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer">
        <i class="fs24 within-circle rango-facebook" title="facebook"></i> </a>
    <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer">
        <i class="fs24 within-circle rango-twitter" title="twitter"></i> </a>
    <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer">
        <i class="fs24 within-circle rango-linked-in" title="linkedin"></i> </a>
    <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer">
        <i class="fs24 within-circle rango-pintrest" title="Pinterest"></i> </a>
    <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer">
        <i class="fs24 within-circle rango-ok" title="Ok"></i> </a>
    <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer">
        <i class="fs24 within-circle rango-instagram" title="instagram"></i></a>
</div>