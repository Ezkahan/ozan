
<header class="header" id="header" style="transition: none !important;">
    <div class="auto__container">
        <div class="header__inner">
            <div class="header__column">

                <div class="menu_burger" id="burger" onclick="open_menu()">
                    <img src="{{asset('themes/velocity_ozan/assets/images/svg/Menu.svg')}}" alt="menu">
                </div>

                <logo-component add-class="header__logo"></logo-component>
            </div>
            <div class="header__column">
                <searchbar-component></searchbar-component>
                <div class="mobile_search" id="mobile_search">
                    <searchbar-component></searchbar-component>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="mobile_search_btn" onclick="openSearch()">
    <img class="search_img" src="{{asset('themes/velocity_ozan/assets/images/svg/search.svg')}}" alt="">
    <img class="close_img" src="{{asset('themes/velocity_ozan/assets/images/svg/x.svg')}}" alt="">
</div>

@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50){
                    document.querySelector('header').classList.add('stick-2');
                    document.getElementById("upheader").classList.add('stick')
                } else {
                    document.querySelector('header').classList.remove('stick-2');
                    document.getElementById("upheader").classList.remove('stick')
                }
            });
        })()
    </script>
@endpush
