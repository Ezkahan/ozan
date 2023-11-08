{!! view_render_event('bagisto.shop.products.view.stock.before', ['product' => $product]) !!}

<div class="col-12 availability">
    <button type="button"
        class="{{ !$product->haveSufficientQuantity($product->totalQuantity()) ? '' : 'active' }} disable-box-shadow">
        @if ($product->haveSufficientQuantity($product->totalQuantity()) === true)
            {{ __('velocity::app.products.in-stock') }}
        @elseif ($product->haveSufficientQuantity($product->totalQuantity()) > 0)
            {{ __('velocity::app.products.available-for-order') }}
        @else
            {{ __('velocity::app.products.out-of-stock') }}
        @endif
    </button>
</div>

{!! view_render_event('bagisto.shop.products.view.stock.after', ['product' => $product]) !!}
