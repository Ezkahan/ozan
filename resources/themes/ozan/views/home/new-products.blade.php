@if (count(app('Webkul\Product\Repositories\ProductRepository')->getNewProducts()))
<section class="product">
    <div class="auto__container">
        <div class="sectionHeader">
            <div class="sectionHeader__title">
                {{ __('shop::app.home.new-products') }}<br/>
            </div>
            <a href="#" class="sectionHeader__link">
                <span>Посмотреть все</span>
                <i class="icon-chevron-right"></i>
            </a>
        </div>
        <div class="product__row">
            @foreach (app('Webkul\Product\Repositories\ProductRepository')->getNewProducts() as $productFlat)

            @if (core()->getConfigData('catalog.products.homepage.out_of_stock_items'))
                @include ('shop::products.list.card', ['product' => $productFlat])
            @else
                @if ($productFlat->isSaleable())
                    @include ('shop::products.list.card', ['product' => $productFlat])
                @endif
            @endif

        @endforeach
        </div>
    </div>
</section>
@endif
