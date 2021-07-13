{{--<nav class="row" id="top">
    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.locale-currency')
    </div>

    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.login-section')
    </div>
</nav>--}}
<section class="upheader" id="upheader">
    <div class="auto__container">
        <div class="upheader__inner" id="upheader_inner">
            <div class="upheader__language">
                <i class="icon-global"></i>
                <select
                    name="language"
                    onchange="window.location.href = this.value"
                    aria-label="Locale"
                    @if (count(core()->getCurrentChannel()->locales) == 1)
                        disabled="disabled"
                    @endif>

                    @foreach (core()->getCurrentChannel()->locales as $locale)
                        @if (isset($searchQuery) && $searchQuery)
                            <option
                                value="?{{ $searchQuery }}&locale={{ $locale->code }}"
                                {{ $locale->code == app()->getLocale() ? 'selected' : '' }}>
                                {{ $locale->name }}
                            </option>
                        @else
                            <option value="?locale={{ $locale->code }}" {{ $locale->code == app()->getLocale() ? 'selected' : '' }}>{{ $locale->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="upheader__nav" id="top">
                <a href="{!! url('page/about-us') !!}" class="upheader__nav-link">
                    <i class="icon-info"></i>
                    <span>@lang('app.about_us')</span>
                </a>
                <a href="{!! url('page/delivery') !!}" class="upheader__nav-link">
                    <i class="icon-box"></i>
                    <span>@lang('app.shipment_policy')</span>
                </a>
                <a href="{!! url('page/payment-policy') !!}" class="upheader__nav-link">
                    <i class="icon-money"></i>
                    <span>@lang('app.payment_policy')</span>
                </a>
                <a href="{!! url('page/cutomer-service') !!}" class="upheader__nav-link">
                    <i class="icon-help"></i>
                    <span>@lang('app.customer_service')</span>
                </a>
                @include('velocity::layouts.top-nav.login-section')



                <a href="{!! url('page/cutomer-service') !!}" class="upheader__nav-link">
                    <i class="material-icons">favorite_border</i>
                    <span>Halanlarym</span>
                </a>
                <a href="{!! url('page/cutomer-service') !!}" class="upheader__nav-link">
                    <i class="material-icons">compare_arrows</i>
                    <span>Deňeşdirmek</span>
                </a>
            </div>
        </div>
    </div>
</section>