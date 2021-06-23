@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.cart.title') }}
@stop

@section('content-wrapper')
<!-- header end
=========================================== -->
<div class="breadcumb">
    <div class="auto__container">
        <div class="breadcumb__inner">
            <a href="index.html">
                <span>Главная</span>
                <i class="icon-chevron-right"></i>
            </a>
            <a href="#">Корзина</a>
        </div>
    </div>
</div>
<!-- category start
=========================================== -->
<div class="delivery">
    <div class="auto__container">

        <div class="delivery__inner">
            <!-- table start
            =========================================== -->
      
            <section class="table">
         
                <div class="delivery__form">
                    <div class="sectionHeader">
                        <div class="sectionHeader__title">
                            Доставка
                        </div>
                    </div>
                    <div class="delivery__form-row">
                        <div class="delivery__form-column">
                            <div class="delivery__form-column-label">
                                Имя и Фамилия <span>*</span>
                            </div>
                            <div class="delivery__form-column-input">
                                <input type="name" required placeholder="name">
                            </div>
                        </div>
                        <div class="delivery__form-column">
                            <div class="delivery__form-column-label">
                                Номер телефона <span>*</span>
                            </div>
                            <div class="delivery__form-column-input">
                                <input type="phone" required placeholder="phone">
                            </div>
                        </div>
                        <div class="delivery__form-column">
                            <div class="delivery__form-column-label">
                                Дополнительный номер телефона
                            </div>
                            <div class="delivery__form-column-input">
                                <input type="name" placeholder="phone">
                            </div>
                        </div>
                        <div class="delivery__form-column">
                            <div class="delivery__form-column-label">
                                Адрес <span>*</span>
                            </div>
                            <div class="delivery__form-column-input">
                                <input type="name" required placeholder="Адрес">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sectionHeader">
                    <div class="sectionHeader__title">
                        Корзина
                    </div>
                </div>
                <div class="table__header">
                    <div class="table__header-row">
                        Наименование
                    </div>
                    <div class="table__header-row">
                        <div class="table__header-column">
                            Количество
                        </div>
                        <div class="table__header-column">
                            Цена
                        </div>
                    </div>

                </div>
                <div class="table__body">
                    <div class="table__row">
                        <div class="table__column">
                            <div class="table__column-image">
                                <picture>
                                    <img src="images/product/2.png" alt="">
                                </picture>
                            </div>
                            <div class="table__column-name">
                                <p>
                                    Apple <strong>iPhone XS A2097 64 ГБ,</strong> 256 ГБ восстановленный,
                                    разблокированный,
                                    одна
                                    SIM-карта
                                </p>

                            </div>
                        </div>
                        <div class="table__column">
                            <div class="table__column-quant">
                                2
                            </div>
                            <div class="table__column-price">
                                12 500.00 TMT
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- table end
            =========================================== -->
            <!-- sidebar start
            ======================================== -->
            <form action="#" class="sidebar">
                <div class="sidebar__inner">
                    <div class="sidebar__header">
                        Методы оплаты
                    </div>
                    <div class="sidebar__info">
                        <div class="sidebar__info-input">
                            <label for="">
                                Введите промокод
                            </label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="sidebar__info">
                        <div for="payment" class="sidebar__info-radio">
                            <div class="sidebar__info-radio-input">
                                <input checked type="radio" name="payment" id="online">
                                <label for="online"></label>
                            </div>
                            <div class="label">Оплата онлайн</div>
                        </div>
                        <label for="payment" class="sidebar__info-radio">
                            <div class="sidebar__info-radio-input">
                                <input type="radio" name="payment" id="card">
                                <label for="card"></label>
                            </div>
                            <div class="label">Оплата картой при получении товара</div>
                        </label>
                        <label for="payment" class="sidebar__info-radio">
                            <div class="sidebar__info-radio-input">
                                <input type="radio" name="payment" id="cash">
                                <label for="cash"></label>
                            </div>
                            <div class="label">Оплата наличными средствами</div>
                        </label>
                        <label for="payment" class="sidebar__info-radio">
                            <div class="sidebar__info-radio-input">
                                <input type="radio" name="payment" id="pay">
                                <label for="pay"></label>
                            </div>
                            <div class="label">Оплата через Rysgal pay</div>
                        </label>
                    </div>
                    <div class="sidebar__info">
                        <div class="sidebar__info-row">
                            <div class="sidebar__info-column">
                                Итоговая Cумма:
                            </div>
                            <div class="sidebar__info-column present">
                                80 346.25 TMT
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="sidebar__submit">
                    Перейти к оплате
                </button>
            </form>
            <!-- sidebar end
            ======================================== -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
    @include('shop::checkout.cart.coupon')

    <script type="text/x-template" id="quantity-changer-template">
        <div class="quantity control-group" :class="[errors.has(controlName) ? 'has-error' : '']">
            <div class="wrap">
                <label>{{ __('shop::app.products.quantity') }}</label>

                <button type="button" class="decrease" @click="decreaseQty()">-</button>

                <input :name="controlName" class="control" :value="qty" v-validate="'required|numeric|min_value:1'" data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;" readonly>

                <button type="button" class="increase" @click="increaseQty()">+</button>

                <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
            </div>
        </div>
    </script>

    <script>
        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',

            inject: ['$validator'],

            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            watch: {
                quantity: function (val) {
                    this.qty = val;

                    this.$emit('onQtyUpdated', this.qty)
                }
            },

            methods: {
                decreaseQty: function() {
                    if (this.qty > 1)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        function removeLink(message) {
            if (!confirm(message))
            event.preventDefault();
        }

        function updateCartQunatity(operation, index) {
            var quantity = document.getElementById('cart-quantity'+index).value;

            if (operation == 'add') {
                quantity = parseInt(quantity) + 1;
            } else if (operation == 'remove') {
                if (quantity > 1) {
                    quantity = parseInt(quantity) - 1;
                } else {
                    alert('{{ __('shop::app.products.less-quantity') }}');
                }
            }
            document.getElementById('cart-quantity'+index).value = quantity;
            event.preventDefault();
        }
    </script>
@endpush