<nav class="row" id="top">
    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.locale-currency')
    </div>

    <div class="col-sm-6">
        @include('velocity::layouts.top-nav.login-section')
    </div>
</nav>
<section class="upheader">
    <div class="auto__container">
        <div class="upheader__inner">
            <div class="upheader__language">
                <i class="icon-global"></i>
                <select name="language" id="">
                    <option value="0">Русский</option>
                    <option value="1">Русский</option>
                    <option value="2">Русский</option>
                </select>
            </div>
            <div class="upheader__nav">
                <a href="about.html" class="upheader__nav-link">
                    <i class="icon-info"></i>
                    <span>О нас</span>
                </a>
                <a href="delivery.html" class="upheader__nav-link">
                    <i class="icon-box"></i>
                    <span>Доставка</span>
                </a>
                <a href="#" class="upheader__nav-link">
                    <i class="icon-money"></i>
                    <span>Методы оплаты</span>
                </a>
                <a href="#" class="upheader__nav-link">
                    <i class="icon-help"></i>
                    <span>Поддержка</span>
                </a>
            </div>
        </div>
    </div>
</section>