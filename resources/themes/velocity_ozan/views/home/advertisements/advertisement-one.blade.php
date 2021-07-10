@php
    $isRendered = false;
    $advertisementOne = null;
@endphp

@if ($velocityMetaData && $velocityMetaData->advertisement)
    @php
        $advertisement = json_decode($velocityMetaData->advertisement, true);
        if (isset($advertisement[1])) {
            $advertisementOne = $advertisement[1];
        }
    @endphp

    @if ($advertisementOne)
        @php
            $isRendered = true;

            $reklamaSlides = [];

            foreach ($advertisementOne as $adv){
                $reklamaSlides[] = [
                    'slider_path' => '/',
                    'path' => '/'
                ];
            }

        @endphp
        <section class="sectionBanner">
            <div class="auto__container">
                <div class="sectionBanner__inner">
                    <div class="banner_box">
                        <slider  :slides='@json($reklamaSlides)' public_path="{{ url()->to('/storage/') }}" item_class="birklas" :time=3000 ></slider>
                    </div>
                </div>
            </div>
        </section>

    @endif
@endif

@if (! $isRendered)
    <div class="container-fluid advertisement-one">
        <div class="row">
            <div class="col offers-lt-panel bg-image"></div>

            <div class="col offers-ct-panel">

                <div class="row pb10">
                    <div class="col-12 offers-ct-top"></div>
                </div>

                <div class="row">
                    <div class="col-12 offers-ct-bottom"></div>
                </div>

            </div>

            <div class="col offers-rt-panel"></div>
        </div>
    </div>
@endif