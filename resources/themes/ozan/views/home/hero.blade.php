<?php

$categories = [];
$heroSlides = $sliderData->where('title','top_hero')->toArray();

foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category) {
    if ($category->slug) {
        array_push($categories, $category);
    }
}
?>
<section class="hero">
    <div class="auto__container">
        <div class="hero__inner">
            <div class="hero__sidebar">
                <div class="hero__sidebar-inner faq" id="accordion">
                    @foreach ($categories as $category)
                    <a href="{{ $category['url_path'] }}" class="card" style="cursor: pointer;border-radius: 0;" data-toggle="collapse" data-target="#faqCollapse-{{ $loop->iteration }}" data-aria-expanded="true" data-aria-controls="faqCollapse-{{ $loop->iteration }}">
                        <div class="hero__sidebar-inner-link" id="faqHeading-{{ $loop->iteration }}">
                            <i class="{{ $category['icon'] }}">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span><span class="path19"></span>
                            </i>
                            <span class="faq-title"> {{ $category['name'] }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @if ($heroSlides)
            <div class="hero__content">
                <slider  :slides='@json($heroSlides)' public_path="{{ url()->to('/storage/') }}" item_class="hero__slider-item" :time=4000></slider>
            </div>
            @endif
        </div>
    </div>
</section>