
<header class="header">
    <div class="auto__container">
        <div class="header__inner">
            <div class="header__column">

                <div class="menu_burger">
                    <!-- <img src="../../../../../../public/themes/velocity_ozan/assets/images/svg/Menu.svg" alt="menu"> -->
                    mmm
                </div>

                <logo-component add-class="header__logo"></logo-component>
            </div>
            <div class="header__column">
                <searchbar-component></searchbar-component>

                <a href="#" class="cart">
                    <!-- <img src="../../../../../../public/themes/velocity_ozan/assets/images/svg/Cart.svg" alt="cart"> -->
                    ooo
                </a>

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



<!-- <script>



</script> -->