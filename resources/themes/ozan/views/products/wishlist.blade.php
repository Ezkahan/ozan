@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

@auth('customer')
    {!! view_render_event('bagisto.shop.products.wishlist.before') !!}

    <a
        @if ($wishListHelper->getWishlistProduct($product))
            class="add-to-wishlist already card__heart"
            title="{{ __('shop::app.customer.account.wishlist.remove-wishlist-text') }}"
        @else
            class="add-to-wishlist card__heart"
            title="{{ __('shop::app.customer.account.wishlist.add-wishlist-text') }}"
        @endif
        id="wishlist-changer"
        style="margin-right: 15px;"
        href="{{ route('customer.wishlist.add', $product->product_id) }}">
        <i class="icon wishlist-icon"></i>
    </a>

    {!! view_render_event('bagisto.shop.products.wishlist.after') !!}
@endauth
