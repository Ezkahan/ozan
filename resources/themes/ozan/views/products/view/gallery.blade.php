@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

<?php
    $images = productimage()->getGalleryImages($product);

  //  $videos = productvideo()->getVideos($product);

  //  $images = array_merge($images, $videos);
?>


{!! view_render_event('bagisto.shop.products.view.gallery.before', ['product' => $product]) !!}

<div class="detail__slider-outer">
    <div class="detail__slider">
        @foreach ($images as $image)
        <div class="detail__slider-item">
            <img src="{{$image['original_image_url']}}" alt="">
        </div>
        @endforeach
        
        
    </div>
    <div class="detail__slider-nav">
        @foreach ($images as $image)
        <div class="detail__slider-nav-item">
            <img src="{{$image['original_image_url']}}" alt="">
        </div>
        @endforeach
    </div>
</div>
{!! view_render_event('bagisto.shop.products.view.gallery.after', ['product' => $product]) !!}

@push('scripts')


@endpush