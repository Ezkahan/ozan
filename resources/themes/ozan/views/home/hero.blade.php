
<?php

$categories = [];
$categoryRepository = app('Webkul\Category\Repositories\CategoryRepository');

$category = $categoryRepository->getVisibleCategoryTree();
dd($category);
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
                        <div class="card" style="cursor: pointer;border-radius: 0;" data-toggle="collapse" data-target="#faqCollapse-{{ $loop->iteration }}" data-aria-expanded="true" data-aria-controls="faqCollapse-{{ $loop->iteration }}">
                            <div class="hero__sidebar-inner-link" id="faqHeading-{{ $loop->iteration }}">
                                <i class="icon-{{ $category['icon'] }}"></i>
                                <span class="faq-title"> {{ $category['name'] }}</span>
                            </div>
                            <div id="faqCollapse-{{ $loop->iteration }}" class="collapse" aria-labelledby="faqHeading-{{ $loop->iteration }}" data-callback="console.log(true);" data-parent="#accordion">
                                <div class="card-body" style="padding: 10px;">
                                    @foreach($category->children as $child)
                                        <a href="{{ $child['url_path'] }}" class="hero__sidebar-inner-link ">
                                            <i class="icon-{{ $child['icon'] }}"></i>
                                            <span>{{$child['name']}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
