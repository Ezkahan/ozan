<header class="sticky-header">
    <div class="row remove-padding-margin velocity-divide-page">
        <logo-component add-class="navbar-brand"></logo-component>
        <searchbar-component></searchbar-component>
    </div>
</header>
<header class="header">
    <div class="auto__container">
        <div class="header__inner">
            <div class="header__column">
                <div class="header__logo">
                    <img src="/themes/ozan/assets/images/logo.svg" alt="">
                </div>
                <div class="header__menu">
                    <div class="menu" onclick="showMenu()">
                        <button class="menu__btn ham" id="menuBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="13.5" viewBox="0 0 19.5 13.5">
                                <g id="align-justify" transform="translate(-2.25 -5.25)">
                                    <line id="Line_57" data-name="Line 57" x1="10" transform="translate(3 12)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                                    <line id="Line_58" data-name="Line 58" x1="18" transform="translate(3 6)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                                    <line id="Line_59" data-name="Line 59" x1="18" transform="translate(3 18)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                                </g>
                            </svg>
                            <span>Меню</span>
                        </button>
                        <div id="menuDropdown" class="menu__content ham">
                            <div class="menu__content-header">
                                <div class="menu__content-header-logo">
                                    <img src="/themes/ozan/assets/images/logo.svg" alt="">
                                </div>
                                <div class="menu__content-header-close" onclick="closeMenu()">
                                    <i class="icon-close"></i>
                                </div>
                            </div>
                            <a href="about.html" class="menu__content-link">
                                <i class="icon-info"></i>
                                О нас
                            </a>
                            <a href="delivery.html" class="menu__content-link">
                                <i class="icon-box"></i>
                                Доставка
                            </a>
                            <a href="#" class="menu__content-link">
                                <i class="icon-money"></i>
                                Методы оплаты
                            </a>
                            <a href="#" class="menu__content-link">
                                <i class="icon-help"></i>
                                Поддержка
                            </a>
                            <a href="favourite.html" class="menu__content-link">
                                <i class="icon-star"></i>
                                Избранное
                            </a>
                            <a href="basket.html" class="menu__content-link">
                                <i class="icon-Inactive"></i>
                                Корзина
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__column">
                <form class="search">
                    <div class="search__input">
                        <input type="text" placeholder="Поиск">
                    </div>
                    <button type="submit" class="search__btn">Найти</button>
                </form>
                <div class="header__column-row">
                    <a href="#" class="dropdown__btn" id="modalBtn">
                        <i class="icon-user"></i>
                        <span>Профиль</span>
                    </a>
                    <!-- if you loged in it must be like this -->
                    <!-- <div class="dropdown" onclick="showProfile()">
                        <button class="dropdown__btn" id="dropbtn">
                            <i class="icon-user"></i>
                            <span>Профиль</span>
                        </button>
                        <div id="myDropdown" class="dropdown__content">
                            <a href="#" class="dropdown__content-link">
                                <i class="icon-coins"></i>
                                12.00 TMT
                            </a>
                            <a href="#" class="dropdown__content-link">
                                <i class="icon-user"></i>
                                Личный кабинет
                            </a>
                            <a href="#" class="dropdown__content-link">
                                <i class="icon-checklist"></i>
                                Мои заказы
                            </a>
                            <a href="#" class="dropdown__content-link">
                                <i class="icon-logout"></i>
                                Выйти
                            </a>
                        </div>
                    </div> -->
                    <!-- if you loged in it must be like this -->
                    <a href="#" class="dropdown__btn">
                        <i class="icon-star"></i>
                        <span>Избранное</span>
                    </a>
                    <a href="#" class="dropdown__btn">
                        <i class="icon-Inactive"></i>
                        <span>Избранное</span>
                    </a>
                </div>
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
