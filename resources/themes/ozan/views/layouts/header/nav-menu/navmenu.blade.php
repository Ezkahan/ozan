{!! view_render_event('bagisto.shop.layout.header.category.before') !!}

<?php

$categories = [];

foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category) {
    if ($category->slug) {
        array_push($categories, $category);
    }
}

?>


{!! view_render_event('bagisto.shop.layout.header.category.after') !!}
<header class="header">
    <div class="auto__container">
        <div class="header__inner">
            <div class="header__column">
                <div class="header__logo">
                    <a href="/">
                    <img src="/themes/ozan/assets/images/logo.svg" alt="">
                    </a>
                </div>
                {{-- <div class="header__menu">
                    <div class="menu" onclick="showMenu()">
                        <button class="menu__btn ham" id="menuBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="13.5"
                                viewBox="0 0 19.5 13.5">
                                <g id="align-justify" transform="translate(-2.25 -5.25)">
                                    <line id="Line_57" data-name="Line 57" x1="10" transform="translate(3 12)"
                                        fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5" />
                                    <line id="Line_58" data-name="Line 58" x1="18" transform="translate(3 6)"
                                        fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5" />
                                    <line id="Line_59" data-name="Line 59" x1="18" transform="translate(3 18)"
                                        fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5" />
                                </g>
                            </svg>
                            <span> {{ __('velocity::app.home.menu') }}</span>
                        </button>
                        <div id="menuDropdown" class="menu__content ham">
                            <div class="menu__content-header">
                                <div class="menu__content-header-logo">
                                    <img src="images/logo.svg" alt="">
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
                </div> --}}
            </div>
            <div class="header__column">
                <form class="search" role="search" action="{{ route('shop.search.index') }}" method="GET" style="display: inherit;">
                    <div class="search__input">
                        <input
                        required
                        name="term"
                        type="search"
                        value="{{ ! $image_search ? $term : '' }}"
                        class="search-field"
                        id="search-bar"
                        placeholder="{{ __('shop::app.header.search-text') }}"
                    >
                    </div>
                    <button type="submit" class="search__btn">{{ __('shop::app.header.search') }}</button>
                </form>
                <div class="header__column-row">
                    @auth('customer')
                    <h1>authenticated</h1>
                    <a href="{{ route('customer.profile.index') }}" class="dropdown__btn">
                        <i class="icon-user"></i>
                        <span>{{ __('shop::app.header.profile') }}</span>
                    </a>
                    @endauth
                    @guest('customer')
                    <a href="#" class="dropdown__btn" id="modalBtn">
                        <i class="icon-user"></i>
                        <span>{{ __('shop::app.header.profile') }}</span>
                    </a>
                    @endguest
                    
                    <a href="/customer/account/wishlist" class="dropdown__btn">
                        <i class="icon-star"></i>
                        <span>{{ __('shop::app.header.wishlist') }}</span>
                    </a>
                    
                    <a href="/checkout/cart" class="dropdown__btn">
                        <i class="icon-Inactive"></i>
                        <span>{{ __('shop::app.header.cart') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
{{-- 'registerlogin' =>[
    'login' => 'Вход',
    'register' => 'Регистрация',
    'phoneNumber' => 'Номер телефона',
    'password' => 'Пароль',
    'name' => 'Имя',
    'surname' => ' Фамилия',
    'address' => 'Адрес',
    'do-register' => 'Зарегистрироваться',
    'terms' => 'Условия регистрации на сайте!',
    'forgot-password' => 'Забыли пароль?'

], --}}
<div class="modal" id="modal">
    <div class="modal__close" id="modalClose">
        <i class="icon-close"></i>
    </div>
    <div class="modal__inner">
        <div class="modal__header">
            <button class="modal__header-btn active" onclick="logIn()" id="logInBtn">
                {{ __('shop::app.registerlogin.login') }}
            </button>
            <button class="modal__header-btn" onclick="signUp()" id="signUpBtn">
                {{ __('shop::app.registerlogin.register') }}
            </button>
        </div>
        <div class="modal__body">
            <form action="#" class="modal__event active" id="logInForm">
                <div class="modal__event-input">
                    <label class="modal__event-input-label">
                        {{ __('shop::app.registerlogin.phoneNumber') }}
                    </label>
                    <div class="modal__event-input-input">
                        <input type="phone">
                    </div>
                </div>
                <div class="modal__event-input">
                    <label class="modal__event-input-label">
                        {{ __('shop::app.registerlogin.password') }}
                    </label>
                    <div class="modal__event-input-input">
                        <input type="password">
                    </div>
                </div>
                <button type="submit" class="modal__event-submit">
                    {{ __('shop::app.registerlogin.login') }}
                </button>
                <a href="" class="modal__event-forget">
                    {{ __('shop::app.registerlogin.forgot-password') }}
                </a>
            </form>
            <form action="#" class="modal__event" id="signUpForm">
                <div class="modal__event-input">
                    <label class="modal__event-input-label">
                        {{ __('shop::app.registerlogin.phoneNumber') }}
                    </label>
                    <div class="modal__event-input-input">
                        <input type="phone">
                    </div>
                </div>
                <div class="modal__event-input">
                    <label class="modal__event-input-label">
                        {{ __('shop::app.registerlogin.name') }}
                    </label>
                    <div class="modal__event-input-input">
                        <input type="name">
                    </div>
                </div>
                <div class="modal__event-input">
                    <label class="modal__event-input-label">
                        {{ __('shop::app.registerlogin.surname') }}
                    </label>
                    <div class="modal__event-input-input">
                        <input type="surname">
                    </div>
                </div>
                <div class="modal__event-input">
                    <label class="modal__event-input-label">
                        {{ __('shop::app.registerlogin.address') }}
                    </label>
                    <div class="modal__event-input-input">
                        <input type="address">
                    </div>
                </div>
                <div class="modal__event-input">
                    <label class="modal__event-input-label">
                        {{ __('shop::app.registerlogin.password') }}
                    </label>
                    <div class="modal__event-input-input">
                        <input type="password">
                    </div>
                </div>
                <button type="submit" class="modal__event-submit">
                    {{ __('shop::app.registerlogin.register') }}
                </button>
                <a href="" class="modal__event-forget">
                    {{ __('shop::app.registerlogin.terms') }}
                </a>
            </form>
        </div>
    </div>
</div>
@push('scripts')


<script type="text/x-template" id="category-nav-template">

    <ul class="nav">
        <category-item
            v-for="(item, index) in items"
            :key="index"
            :url="url"
            :item="item"
            :parent="index">
        </category-item>
    </ul>

</script>

<script>
    Vue.component('category-nav', {

        template: '#category-nav-template',

        props: {
            categories: {
                type: [Array, String, Object],
                required: false,
                default: (function () {
                    return [];
                })
            },

            url: String
        },

        data: function(){
            return {
                items_count:0
            };
        },

        computed: {
            items: function() {
                return JSON.parse(this.categories)
            }
        },
    });
</script>

<script type="text/x-template" id="category-item-template">
    <li>
        <a :href="url+'/'+this.item['translations'][0].url_path">
            @{{ name }}&emsp;
            <i class="icon dropdown-right-icon" v-if="haveChildren && item.parent_id != null"></i>
        </a>

        <i :class="[show ? 'icon icon-arrow-down mt-15' : 'icon dropdown-right-icon left mt-15']"
        v-if="haveChildren"  @click="showOrHide"></i>

        <ul v-if="haveChildren && show">
            <category-item
                v-for="(child, index) in item.children"
                :key="index"
                :url="url"
                :item="child">
            </category-item>
        </ul>
    </li>
</script>

<script>
    // Vue.component('category-item', {

    //     template: '#category-item-template',

    //     props: {
    //         item:  Object,
    //         url: String,
    //     },

    //     data: function() {
    //         return {
    //             items_count:0,
    //             show: false,
    //         };
    //     },

    //     mounted: function() {
    //         if(window.innerWidth > 770){
    //             this.show = true;
    //         }
    //     },

    //     computed: {
    //         haveChildren: function() {
    //             return this.item.children.length ? true : false;
    //         },

    //         name: function() {
    //             if (this.item.translations && this.item.translations.length) {
    //                 this.item.translations.forEach(function(translation) {
    //                     if (translation.locale == document.documentElement.lang)
    //                         return translation.name;
    //                 });
    //             }

    //             return this.item.name;
    //         }
    //     },

    //     methods: {
    //         showOrHide: function() {
    //             this.show = !this.show;
    //         }
    //     }
    // });
</script>


@endpush