<?php

$categories = [];
$heroSlides = $sliderData->where('title', 'top_hero')->toArray();

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
                            <!-- <i class="{{ $category['icon'] }}">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span><span class="path19"></span>
                            </i> -->
                            <div class="category_icon">
                                <svg>
                                    <use href="#"></use>
                                </svg>
                                <!-- <svg id="monitor" xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20">
                                    <path id="Path_61" data-name="Path 61" d="M0,241.014a1.181,1.181,0,0,0,1.155,1.179H19.845A1.181,1.181,0,0,0,21,241.014V240H0Zm0,0" transform="translate(0 -227.467)" fill="#2d2d2d" />
                                    <path id="Path_62" data-name="Path 62" d="M19.845,0H1.155A1.143,1.143,0,0,0,0,1.136V11.8H21V1.136A1.143,1.143,0,0,0,19.845,0Zm0,0" fill="#2d2d2d" />
                                    <path id="Path_63" data-name="Path 63" d="M115.294,299.5h-2.41V296h-5.117v3.5h-2.135a.522.522,0,1,0,0,1.044h9.663a.522.522,0,1,0,0-1.044Zm0,0" transform="translate(-99.831 -280.543)" fill="#2d2d2d" />
                                </svg> -->

                            </div>
                            <span class="faq-title"> {{ $category['name'] }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @if ($heroSlides)
            <div class="hero__content">
                <slider :slides='@json($heroSlides)' public_path="{{ url()->to('/storage/') }}" item_class="hero__slider-item" time="4000"></slider>
            </div>
            @endif
        </div>
    </div>
</section>