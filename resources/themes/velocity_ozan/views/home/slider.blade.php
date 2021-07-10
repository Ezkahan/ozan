
<section class="hero">
    <div class="auto__container">
        <div class="hero__inner">
            <div class="hero__sidebar">
                
                    {{--<sidebar-component></sidebar-component>--}}
                    <parent-categories public_path="{{ url()->to('/storage/public/') }}"></parent-categories>
                
            </div>
            @if ($sliderData)
                <div class="hero__content">
                    <slider  :slides='@json($sliderData->toArray())' public_path="{{ url()->to('/storage/') }}" item_class="hero__slider-item" :time=4000></slider>
                </div>
            @endif
        </div>
    </div>
</section>