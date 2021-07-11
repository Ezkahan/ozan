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
            pagination-enabled="hide"
            loop="true">

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
