{!! view_render_event('bagisto.shop.products.view.stock.before', ['product' => $product]) !!}

<div class="col-12 availability">
    <button type="button"
        class="{{ !$product->haveSufficientQuantity($product->totalQuantity()) ? '' : 'active' }} disable-box-shadow">
        @if ($product->haveSufficientQuantity($product->totalQuantity()) === true)
            {{ __('shop::app.products.in-stock') }}
        @elseif ($product->haveSufficientQuantity($product->totalQuantity()) > 0)
            {{ __('shop::app.products.available-for-order') }}
        @else
            {{ __('shop::app.products.out-of-stock') }}
        @endif
    </button>
</div>

{!! view_render_event('bagisto.shop.products.view.stock.after', ['product' => $product]) !!}
