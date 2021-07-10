@php
    $isRendered = false;
    $advertisementFour = null;
@endphp

@if ($velocityMetaData && $velocityMetaData->advertisement)
    @php
        $advertisement = json_decode($velocityMetaData->advertisement, true);

        if (isset($advertisement[4]) && is_array($advertisement[4])) {
            $advertisementFour = array_values(array_filter($advertisement[4]));
        }

    @endphp

    @if ($advertisementFour)
        @php
            $isRendered = true;

        @endphp
        <carousel-component
            :slides-count="{{ sizeof($advertisementFour) }}"
            slides-per-page="6"
            id="related-products-carousel"
            navigation-enabled="true"
            pagination-enabled="hide">

            @foreach ($advertisementFour as $index => $relatedProduct)
                <slide slot="slide-{{ $index }}">
                    <a href="{{$url[$index] ?? '/'}}">
                        <div class="brand__slider-item-image"><picture><img src="{{url()->to('/storage/'.$relatedProduct)}}" alt=""></picture></div>
                    </a>
                </slide>
            @endforeach
        </carousel-component>

    @endif
@endif

@if (! $isRendered)
    <div class="container-fluid advertisement-four-container">
        <div class="row">
            <a @if (isset($one)) href="{{ $one }}" @endif class="col-lg-4 col-12 no-padding" aria-label="Advertisement">
                <img class="col-12 lazyload" data-src="{{ asset('/themes/velocity/assets/images/big-sale-banner.webp') }}" alt="" />
            </a>

            <div class="col-lg-4 col-12 offers-ct-panel">
                <a @if (isset($two)) href="{{ $two }}" @endif class="row col-12 remove-padding-margin" aria-label="Advertisement">
                    <img class="col-12 offers-ct-top lazyload" data-src="{{ asset('/themes/velocity/assets/images/seasons.webp') }}" alt="" />
                </a>
                <a @if (isset($three)) href="{{ $three }}" @endif class="row col-12 remove-padding-margin" aria-label="Advertisement">
                    <img class="col-12 offers-ct-bottom lazyload" data-src="{{ asset('/themes/velocity/assets/images/deals.webp') }}" alt="" />
                </a>
            </div>

            <a @if (isset($four)) href="{{ $four }}" @endif class="col-lg-4 col-12 no-padding" aria-label="Advertisement">
                <img class="col-12 lazyload" data-src="{{ asset('/themes/velocity/assets/images/kids.webp') }}" alt="" />
            </a>
        </div>
    </div>
@endif