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
            $slides = [];
            foreach ($advertisementFour as $adv) {
                $slides[] =['path'=>$adv,'slider_path'=> $url[0]??url()->to('/page/our-brands')];
            }

        @endphp


        <!--  -->
        <slider  :slides='@json($slides)' public_path="{{ url()->to('/storage/') }}" item_class="brand__slider-item-image" :time=4000 :items=6></slider>
        <!--  -->

    @endif
@endif
