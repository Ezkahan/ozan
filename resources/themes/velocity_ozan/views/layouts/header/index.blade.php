
<header class="header">
    <div class="auto__container">
        <div class="header__inner">
            <div class="header__column">
{{--                <div class="header__logo">--}}
{{--                    <img src="/themes/ozan/assets/images/logo.svg" alt="">--}}
{{--                </div>--}}
                <logo-component add-class="header__logo"></logo-component>
            </div>
            <div class="header__column">
                <searchbar-component></searchbar-component>
            </div>
        </div>
    </div>
</header>
@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50){
                    document.querySelector('header').classList.add('header-shadow');
                } else {
                    document.querySelector('header').classList.remove('header-shadow');
                }
            });
        })()
    </script>
@endpush
