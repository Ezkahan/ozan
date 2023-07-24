import Vue from 'vue';
import accounting from 'accounting';
import VueCarousel from 'vue-carousel';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/index.css';
import ru from 'vee-validate/dist/locale/ru';
// import tm from 'vee-validate/dist/locale/tr';
import tm from './lang/tm'
import VeeValidate, { Validator } from 'vee-validate';
import axios from 'axios';
import 'lazysizes';

window.axios = axios;
window.VeeValidate = VeeValidate;
window.jQuery = window.$ = require("jquery");
window.BootstrapSass = require("bootstrap-sass");

Vue.use(VueToast);
Vue.use(VueCarousel);
Vue.use(BootstrapSass);
Vue.prototype.$http = axios;

Vue.use(VeeValidate, {
    dictionary: {
        // ar: ar,
        ru: ru,
        tm: tm,
    }
});

Vue.filter('currency', function (value, argument) {
    return accounting.formatMoney(value, argument);
})

window.Vue = Vue;
window.Carousel = VueCarousel;

// UI components
Vue.component("vue-slider", require("vue-slider-component"));
Vue.component('mini-cart', require('./UI/components/mini-cart'));
Vue.component('modal-component', require('./UI/components/modal'));
Vue.component("add-to-cart", require("./UI/components/add-to-cart"));
Vue.component('star-ratings', require('./UI/components/star-rating'));
Vue.component('quantity-btn', require('./UI/components/quantity-btn'));
Vue.component('proceed-to-checkout', require('./UI/components/proceed-to-checkout'));
Vue.component('sidebar-component', require('./UI/components/sidebar'));
Vue.component("product-card", require("./UI/components/product-card"));
Vue.component("wishlist-component", require("./UI/components/wishlist"));
Vue.component('carousel-component', require('./UI/components/carousel'));
Vue.component('child-sidebar', require('./UI/components/child-sidebar'));
Vue.component('card-list-header', require('./UI/components/card-header'));
Vue.component('magnify-image', require('./UI/components/image-magnifier'));
Vue.component('compare-component', require('./UI/components/product-compare'));
Vue.component("shimmer-component", require("./UI/components/shimmer-component"));
Vue.component('responsive-sidebar', require('./UI/components/responsive-sidebar'));
Vue.component('product-quick-view', require('./UI/components/product-quick-view'));
Vue.component('product-quick-view-btn', require('./UI/components/product-quick-view-btn'));
Vue.component('recently-viewed', require('./UI/components/recently-viewed'));
Vue.component('product-collections', require('./UI/components/product-collections'));
Vue.component('hot-category', require('./UI/components/hot-category'));
Vue.component('popular-category', require('./UI/components/popular-category'));

Vue.component('slider', require('./UI/components/slider'));
Vue.component('categories', require('./UI/components/categories'));
Vue.component('parent-categories', require('./UI/components/parent-categories'));
window.eventBus = new Vue();

$(document).ready(function () {
    // define a mixin object
    Vue.mixin(require('./UI/components/trans'));

    Vue.mixin({
        data: function () {
            return {
                'imageObserver': null,
                'navContainer': false,
                'headerItemsCount': 0,
                'sharedRootCategories': [],
                'responsiveSidebarTemplate': '',
                'responsiveSidebarKey': Math.random(),
                'baseUrl': document.querySelector("script[src$='ozan.js']").getAttribute('baseUrl')
            }
        },

        methods: {
            redirect: function (route) {
                route ? window.location.href = route : '';
            },

            debounceToggleSidebar: function (id, {target}, type) {
                // setTimeout(() => {
                    this.toggleSidebar(id, target, type);
                // }, 500);
            },

            toggleSidebar: function (id, {target}, type) {
                if (
                    Array.from(target.classList)[0] == "main-category"
                    || Array.from(target.parentElement.classList)[0] == "main-category"
                ) {
                    let sidebar = $(`#sidebar-level-${id}`);
                    if (sidebar && sidebar.length > 0) {
                        if (type == "mouseover") {
                            this.show(sidebar);
                        } else if (type == "mouseout") {
                            this.hide(sidebar);
                        }
                    }
                } else if (
                    Array.from(target.classList)[0]     == "category"
                    || Array.from(target.classList)[0]  == "category-icon"
                    || Array.from(target.classList)[0]  == "category-title"
                    || Array.from(target.classList)[0]  == "category-content"
                    || Array.from(target.classList)[0]  == "rango-arrow-right"
                ) {
                    let parentItem = target.closest('li');

                    if (target.id || parentItem.id.match('category-')) {
                        let subCategories = $(`#${target.id ? target.id : parentItem.id} .sub-categories`);

                        if (subCategories && subCategories.length > 0) {
                            let subCategories1 = Array.from(subCategories)[0];
                            subCategories1 = $(subCategories1);

                            if (type == "mouseover") {
                                this.show(subCategories1);

                                let sidebarChild = subCategories1.find('.sidebar');
                                this.show(sidebarChild);
                            } else if (type == "mouseout") {
                                this.hide(subCategories1);
                            }
                        } else {
                            if (type == "mouseout") {
                                let sidebar = $(`#${id}`);
                                sidebar.hide();
                            }
                        }
                    }
                }
            },

            show: function (element) {
                element.show();
                element.mouseleave(({target}) => {
                    $(target.closest('.sidebar')).hide();
                });
            },

            hide: function (element) {
                element.hide();
            },

            toggleButtonDisability ({event, actionType}) {
                let button = event.target.querySelector('button[type=submit]');

                button ? button.disabled = actionType : '';
            },

            onSubmit: function (event) {
                this.toggleButtonDisability({event, actionType: true});

                if(typeof tinyMCE !== 'undefined')
                    tinyMCE.triggerSave();

                this.$validator.validateAll().then(result => {
                    if (result) {
                        event.target.submit();
                    } else {
                        this.toggleButtonDisability({event, actionType: false});

                        eventBus.$emit('onFormError')
                    }
                });
            },

            isMobile: function () {

                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i|/mobi/i.test(navigator.userAgent)) {
                    if (this.isMaxWidthCrossInLandScape()) {
                        return false;
                    }
                    return true
                } else {
                    return false
                }
            },

            isMaxWidthCrossInLandScape: function() {
                return window.innerWidth > 900;
            },

            isPlanshet: function() {
                return window.innerWidth > 425;
            },
            getDynamicHTML: function (input) {
                var _staticRenderFns;
                const { render, staticRenderFns } = Vue.compile(input);

                if (this.$options.staticRenderFns.length > 0) {
                    _staticRenderFns = this.$options.staticRenderFns;
                } else {
                    _staticRenderFns = this.$options.staticRenderFns = staticRenderFns;
                }

                try {
                    var output = render.call(this, this.$createElement);
                } catch (exception) {
                    console.log(this.__('error.something_went_wrong'));
                }

                this.$options.staticRenderFns = _staticRenderFns;

                return output;
            },

            getStorageValue: function (key) {
                let value = window.localStorage.getItem(key);

                if (value) {
                    value = JSON.parse(value);
                }

                return value;
            },

            setStorageValue: function (key, value) {
                window.localStorage.setItem(key, JSON.stringify(value));

                return true;
            },
        }
    });

    const app = new Vue({
        el: "#app",
        VueToast,

        data: function () {
            return {
                modalIds: {},
                miniCartKey: 0,
                quickView: false,
                productDetails: [],
                showPageLoader: false,
            }
        },

        created: function () {
            setTimeout(() => {
                document.body.classList.remove("modal-open");
            }, 0);

            window.addEventListener('click', () => {
                let modals = document.getElementsByClassName('sensitive-modal');

                Array.from(modals).forEach(modal => {
                    modal.classList.add('hide');
                });
            });
        },

        mounted: function () {
            setTimeout(() => {
                this.addServerErrors();
            }, 0);

            document.body.style.display = "block";
            this.$validator.localize(document.documentElement.lang);

            this.loadCategories();
            this.addIntersectionObserver();
        },

        methods: {
            onSubmit: function (event) {
                this.toggleButtonDisability({event, actionType: true});

                if(typeof tinyMCE !== 'undefined')
                    tinyMCE.triggerSave();

                this.$validator.validateAll().then(result => {
                    if (result) {
                        event.target.submit();
                    } else {
                        this.toggleButtonDisability({event, actionType: false});

                        eventBus.$emit('onFormError')
                    }
                });
            },

            toggleButtonDisable (value) {
                var buttons = document.getElementsByTagName("button");

                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].disabled = value;
                }
            },

            addServerErrors: function (scope = null) {
                for (var key in serverErrors) {
                    var inputNames = [];
                    key.split('.').forEach(function(chunk, index) {
                        if(index) {
                            inputNames.push('[' + chunk + ']')
                        } else {
                            inputNames.push(chunk)
                        }
                    })

                    var inputName = inputNames.join('');

                    const field = this.$validator.fields.find({
                        name: inputName,
                        scope: scope
                    });

                    if (field) {
                        this.$validator.errors.add({
                            id: field.id,
                            field: inputName,
                            msg: serverErrors[key][0],
                            scope: scope
                        });
                    }
                }
            },

            addFlashMessages: function () {
                if (window.flashMessages.alertMessage)
                    window.alert(window.flashMessages.alertMessage);
            },

            showModal: function (id) {
                this.$set(this.modalIds, id, true);
            },

            loadCategories: function () {
                this.$http.get(`${this.baseUrl}/categories`)
                .then(response => {
                    this.sharedRootCategories = response.data.categories;
                    $(`<style type='text/css'> .sub-categories{ min-height:${response.data.categories.length * 30}px;} </style>`).appendTo("head");
                })
                .catch(error => {
                    console.log('failed to load categories');
                })
            },

            addIntersectionObserver: function () {
                this.imageObserver = new IntersectionObserver((entries, imgObserver) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const lazyImage = entry.target
                            lazyImage.src = lazyImage.dataset.src
                        }
                    })
                });
            },

            showLoader: function () {
                $('#loader').show();
                $('.overlay-loader').show();

                document.body.classList.add("modal-open");
            },

            hideLoader: function () {
                $('#loader').hide();
                $('.overlay-loader').hide();

                document.body.classList.remove("modal-open");
            }
        }
    });

    window.app = app;

    // for compilation of html coming from server
    Vue.component('vnode-injector', {
        functional: true,
        props: ['nodes'],
        render(h, {props}) {
            return props.nodes;
        }
    });
});

function sleep(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}

let add_address = document.querySelector(".add_address");
let add_btn = document.querySelector(".add_new_address");
let remove_btn = document.querySelector(".close_mail_btn");
let rework_check = document.querySelectorAll(".rework_check");
let account_table_btn = document.querySelectorAll(".account_table_btn");
let account_info = document.querySelectorAll(".account_info");
let account_link = document.querySelectorAll(".account_link");
let account_infos = document.querySelectorAll(".account_infos");
let tab_link = document.querySelector("#tab-3");
let account_tab = document.querySelector("#account_tab-3");

let menu_burger = document.querySelector(".menu_burger img");
let upheader = document.querySelector(".upheader");
let upheader__inner = document.querySelector(".upheader__inner");


function open_menu() {
    sleep(2).then(() => {
        document.getElementById('upheader').classList.add('active');
        document.getElementById('upheader_inner').classList.add('active');
    });
}


if (add_btn != undefined) {
    add_btn.addEventListener('click', function () {
        sleep(2).then(() => {
            add_address.classList.add('active');
        });
    });
}

if (remove_btn != undefined) {
    remove_btn.addEventListener('click', function () {
        sleep(2).then(() => {
            add_address.classList.remove('active');
        });
    });
}

if (account_table_btn != undefined) {
    account_table_btn.forEach(v => {
        v.addEventListener('click', function (e) {
            sleep(2).then(() => {
                account_info.forEach(o => {
                    o.classList.remove('active');
                })
            });
        });
    })
}

if (account_link != undefined) {
    account_link.forEach(v => {
        v.addEventListener('click', function (e) {
            sleep(2).then(() => {
                account_infos.forEach(o => {
                    o.classList.remove('active');
                })
            });
        });
    })
}

if (tab_link != undefined) {
    tab_link.addEventListener('click', function () {
        sleep(2).then(() => {
            account_tab.classList.add('active');
        });
    });
}


// if (rework_check != undefined) {

//   rework_check.forEach(x => {
//     x.addEventListener('click', function () {
//       console.log(rework_check);
//       console.log("rework_check");
//       x.classList.toggle('active');
//     });
//   })
// }

function showCat() {
    document.getElementById("cat_sidebar").classList.toggle("active");
}


let modal = document.getElementById("modal");
let modalBtn = document.getElementById("modalBtn");
let modalClose = document.getElementById("modalClose");
// modalBtn.onclick = function (e) {
//     modal.style.display = "block";
// };
// modalClose.onclick = function () {
//   modal.style.display = "none";
// };
function showProfile() {
    document.getElementById("myDropdown").classList.toggle("show");
    document.getElementById("dropbtn").classList.toggle("active");
}
function showMenu() {
    document.getElementById("menuDropdown").classList.toggle("show");
    document.getElementById("menuBtn").classList.toggle("active");
}
function closeMenu() {
    document.getElementById("menuDropdown").classList.remove("show");
    document.getElementById("menuBtn").classList.remove("active");
}
function logIn() {
    document.getElementById("logInBtn").classList.add("active");
    document.getElementById("signUpBtn").classList.remove("active");
    document.getElementById("logInForm").classList.add("active");
    document.getElementById("signUpForm").classList.remove("active");
}
function signUp() {
    document.getElementById("logInBtn").classList.remove("active");
    document.getElementById("signUpBtn").classList.add("active");
    document.getElementById("logInForm").classList.remove("active");
    document.getElementById("signUpForm").classList.add("active");
}

let forget = document.querySelector(".forget");
let forget_mail = document.querySelector(".forget_mail");
let forget_pass = document.querySelector(".forget_pass");



window.onclick = function (event) {
    if (
        !event.target.matches(".dropdown__btn") &
        !event.target.matches(".menu__btn")
    ) {
        let dropdowns = document.getElementsByClassName("dropdown__content");
        let menus = document.getElementsByClassName("menu__content");

        let i;
        for (i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
                document.getElementById("dropbtn").classList.remove("active");
            }
        }
        let x;
        for (x = 0; x < menus.length; x++) {
            let openMenus = menus[x];
            if (openMenus.classList.contains("show")) {
                openMenus.classList.remove("show");
                document.getElementById("menuBtn").classList.remove("active");
            }
        }
    }
    if (event.target == modal) {
        modal.style.display = "none";
    }

    if (forget != undefined) {
        if (forget.classList.contains('active') && !event.target.closest('.forget_mail') && !event.target.closest('.forget_pass')) {
            forget.classList.remove('active');
        }
    }


    if (add_address != undefined) {
        if (add_address.classList.contains('active') && !event.target.closest('.forget_mail') && !event.target.closest('.forget_pass')) {
            add_address.classList.remove('active');
        }
    }

    if (document.getElementById('upheader').classList.contains('active') && !event.target.closest('.upheader_inner') && !event.target.closest('.upheader__nav-link') && !event.target.closest('.upheader__language')) {
        document.getElementById('upheader').classList.remove('active')
    }

    if (document.getElementById('upheader_inner').classList.contains('active') && !event.target.closest('.upheader_inner') && !event.target.closest('.upheader__nav-link') && !event.target.closest('.upheader__language')) {
        document.getElementById('upheader_inner').classList.remove('active')
    }

};

function increment() {
    document.getElementById("demoInput").stepUp();
}
function decrement() {
    document.getElementById("demoInput").stepDown();
}

// For check only once =======================


function onlyOne(checkbox) {
    let checkboxes = document.getElementsByName('check')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false

    })
}


function onlyCheck(check) {
    let checkbox = document.getElementsByName('pay-check')

    checkbox.forEach((items) => {
        if (items !== check) items.checked = false
    })

}
// For check only once =======================



