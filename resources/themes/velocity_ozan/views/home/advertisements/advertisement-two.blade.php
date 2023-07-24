@php
    $isRendered = false;
    $advertisementTwo = null;
@endphp

@if ($velocityMetaData && $velocityMetaData->advertisement)
    @php
        $advertisement = json_decode($velocityMetaData->advertisement, true);

        if (isset($advertisement[2]) && is_array($advertisement[2])) {
            $advertisementTwo = array_values(array_filter($advertisement[2]));
        }

    @endphp

    @if ($advertisementTwo)
        @php
            $isRendered = true;
            $slides = [];
            foreach ($advertisementTwo as $adv){
                $slides[] =['path'=>$adv,'slider_path'=> $url[0]??'/'];
            }

        @endphp

            <div class="adert_slider">
                <slider  :slides='@json($slides)' public_path="{{ url()->to('/storage/') }}" item_class="adert_slider_item" :time=3000 ></slider>
            </div>

    @endif
@endif