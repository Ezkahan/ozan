
@if (count($sliderData))
<div class="hero__slider">
    @foreach($sliderData as $slider)
    <div class="hero__slider-item">
        <img src="{{"storage/".$slider['path']}}" alt="">
    </div>
    @endforeach
    
</div>
@endif