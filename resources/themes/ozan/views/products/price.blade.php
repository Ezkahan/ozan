{!! view_render_event('bagisto.shop.products.price.before', ['product' => $product]) !!}


<div class="card__body-price">
    {!! $product->getTypeInstance()->getPriceHtml() !!}
</div>
{{-- <div class="detail__content-after">
    от 12 500.00 TMT
</div>
<div class="product-price">
  
</div> --}}

{!! view_render_event('bagisto.shop.products.price.after', ['product' => $product]) !!}