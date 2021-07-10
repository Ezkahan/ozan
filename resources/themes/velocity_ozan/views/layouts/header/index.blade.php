<header class="sticky-header">
    <div class="row remove-padding-margin velocity-divide-page">
{{--        <logo-component add-class="navbar-brand"></logo-component>--}}
        <searchbar-component></searchbar-component>
    </div>
</header>
<header class="header">
    <div class="auto__container">
        <div class="header__inner">
            <div class="header__column">
                <logo-component add-class="header__logo"></logo-component>
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
