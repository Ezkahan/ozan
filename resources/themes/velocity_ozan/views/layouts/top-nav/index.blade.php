{{--<nav class="row" id="top">
    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.locale-currency')
    </div>

    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.login-section')
    </div>
</nav>--}}
<section class="upheader" id="upheader" style="transition: none !important;">
    <div class="auto__container">
        <div class="upheader__inner" id="upheader_inner">
            <div class="upheader__language">

                <div class="c-lang">
                    <div class="c-current" onclick="openLang()">
                        @if(app()->getLocale() == 'en')
                            <span class="c-icon">
                                <img src="{{asset('themes/velocity_ozan/assets/images/en.png')}}" alt="lang-icon">
                            </span>
                            <span class="c-text">
                                English
                            </span>
                        @endif
                        @if(app()->getLocale() == 'ru')
                            <span class="c-icon">
                                <img src="{{asset('themes/velocity_ozan/assets/images/ru.png')}}" alt="lang-icon">
                            </span>
                            <span class="c-text">
                                Русский
                            </span>
                        @endif
                        @if(app()->getLocale() == 'tm')
                            <span class="c-icon">
                                <img src="{{asset('themes/velocity_ozan/assets/images/tm.png')}}" alt="lang-icon">
                            </span>
                            <span class="c-text">
                                Türkmen
                            </span>
                        @endif
                    </div>

                    <div class="c-group">
                        @foreach (core()->getCurrentChannel()->locales as $locale)
                            @if (isset($searchQuery) && $searchQuery)
                                <a class="c-item" href="?{{ $searchQuery }}&locale={{ $locale->code }}">
                                    <span class="c-icon">
                                        @if( $locale->code == 'en')
                                            <img src="{{asset('themes/velocity_ozan/assets/images/en.png')}}" alt="lang-icon" width="20px" height="18px">
                                        @endif
                                        @if( $locale->code == 'ru')
                                            <img src="{{asset('themes/velocity_ozan/assets/images/ru.png')}}" alt="lang-icon" width="20px" height="18px">
                                        @endif
                                        @if( $locale->code == 'tm')
                                            <img src="{{asset('themes/velocity_ozan/assets/images/tm.png')}}" alt="lang-icon" width="20px" height="18px">
                                        @endif
                                    </span>
                                    <span class="c-text">
                                        {{ $locale->name }}
                                    </span>
                                </a>
                            @else
                                <a class="c-item" href="?locale={{ $locale->code }}">
                                    <span class="c-icon">
                                        @if( $locale->code == 'en')
                                            <img src="{{asset('themes/velocity_ozan/assets/images/en.png')}}" alt="lang-icon" width="20px" height="18px">
                                        @endif
                                        @if( $locale->code == 'ru')
                                            <img src="{{asset('themes/velocity_ozan/assets/images/ru.png')}}" alt="lang-icon" width="20px" height="18px">
                                        @endif
                                        @if( $locale->code == 'tm')
                                            <img src="{{asset('themes/velocity_ozan/assets/images/tm.png')}}" alt="lang-icon" width="20px" height="18px">
                                        @endif
                                    </span>
                                    <span class="c-text">
                                        {{ $locale->name }}
                                    </span>
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="upheader__nav" id="top">
                <a href="{!! url('page/about-us') !!}" class="upheader__nav-link">
                    <i class="icon-info"></i>
                    <span>@lang('app.about_us')</span>
                </a>
                <a href="{!! url('page/shipping-policy') !!}" class="upheader__nav-link">
                    <i class="icon-box"></i>
                    <span>@lang('app.shipment_policy')</span>
                </a>
                <a href="{!! url('page/payment-policy') !!}" class="upheader__nav-link">
                    <i class="icon-money"></i>
                    <span>@lang('app.payment_policy')</span>
                </a>
                <a href="{!! url('brands') !!}" class="upheader__nav-link">
                    <i class="icon-star"></i>
                    <span>@lang('app.our-brands')</span>
                </a>
                <a href="{!! url('shops') !!}" class="upheader__nav-link">
                    <i class="icon-cart"></i>
                    <span>@lang('app.shops')</span>
                </a>
                @php
                    $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;

                    $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;
                @endphp
                @if($showWishlist)
                <a href="{{ route('customer.wishlist.index') }}" class="upheader__nav-link mobile_link">
                    <i class="material-icons">favorite_border</i>
                    <span>{{ __('shop::app.header.wishlist') }}</span>
                </a>
                @endif
                @if ($showCompare)
                <a  class="upheader__nav-link mobile_link"
                    @auth('customer') href="{{ route('velocity.customer.product.compare') }}" @endauth
                    @guest('customer') href="{{ route('velocity.product.compare') }}"@endguest>
                    <i class="material-icons">compare_arrows</i>
                    <span>@lang('velocity::app.customer.compare.text')</span>
                </a>
                @endif
                @include('velocity::layouts.top-nav.login-section')

            </div>
        </div>
    </div>
</section>
