{{--<nav class="row" id="top">
    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.locale-currency')
    </div>

    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.login-section')
    </div>
</nav>--}}
<section class="upheader">
    <div class="auto__container">
        <div class="upheader__inner">
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
                    <span>О нас</span>
                </a>
                <a href="{!! url('page/delivery') !!}" class="upheader__nav-link">
                    <i class="icon-box"></i>
                    <span>Доставка</span>
                </a>
                <a href="{!! url('page/payment-policy') !!}" class="upheader__nav-link">
                    <i class="icon-money"></i>
                    <span>Методы оплаты</span>
                </a>
                <a href="{!! url('page/cutomer-service') !!}" class="upheader__nav-link">
                    <i class="icon-help"></i>
                    <span>Поддержка</span>
                </a>
                @include('velocity::layouts.top-nav.login-section')
            </div>
        </div>
    </div>
</section>