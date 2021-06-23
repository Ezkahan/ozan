
<?php

$categories = [];

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
                <div class="hero__sidebar-inner">
                    @foreach ($categories as $category)
                    <a href="{{$category['url_path']}}" class="hero__sidebar-inner-link ">
                        <i class="icon-skirt"></i>
                        <span>{{$category['name']}}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="hero__content">
                <div class="prev">
                    <i class="icon-chevron-left"></i>
                </div>
                <div class="next">
                    <i class="icon-chevron-right"></i>
                </div>
                @include('shop::home.slider',['sliderData' => $sliderData])
               
            </div>
        </div>
    </div>
</section>