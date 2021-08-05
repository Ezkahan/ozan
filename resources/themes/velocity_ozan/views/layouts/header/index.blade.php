
<header class="header" id="header">
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
