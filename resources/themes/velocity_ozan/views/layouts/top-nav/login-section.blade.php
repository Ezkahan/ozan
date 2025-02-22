{!! view_render_event('bagisto.shop.layout.header.account-item.before') !!}
    <login-header></login-header>
{!! view_render_event('bagisto.shop.layout.header.account-item.after') !!}

@push('scripts')
    <script type="text/x-template" id="login-header-template">
        <div class="dropdown upheader__nav-link">
            <div id="account">
                <div class="d-inline-block welcome-content" @click="togglePopup">
                    <i class="icon-user ml-2"></i>
                    <span class="text-center">
                        @guest('customer')
                            {{ __('velocity::app.header.welcome-message', ['customer_name' => trans('velocity::app.header.guest')]) }}
                        @endguest

                        @auth('customer')
                            {{ __('velocity::app.header.welcome-message', ['customer_name' => auth()->guard('customer')->user()->first_name]) }}
                        @endauth
                    </span>
                    <span class="select-icon rango-arrow-down"></span>
                </div>
            </div>

            <div class="account-modal hide mt5">
                @guest('customer')
                    <div class="modal-content">
                        <!-- header -->
                        <div class="modal-header no-border pb0">
                            <label class="fs18 grey">{{ __('velocity::app.header.title') }}</label>

                            <button type="button" class="close disable-box-shadow" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="white-text fs20" @click="togglePopup">×</span>
                            </button>
                        </div>

                        <!-- body -->
                        <div class="pl10 fs14">
                            <p>{{ __('velocity::app.header.dropdown-text') }}</p>
                        </div>

                        <!-- footer -->
                        <div class="modal-footer">
                            <div>
                                <a href="{{ route('customer.session.index') }}">
                                    <button
                                        type="button"
                                        class="theme-btn fs14 fw6">

                                        {{ __('velocity::app.header.sign-in') }}
                                    </button>
                                </a>
                            </div>

                            <div>
                                <a href="{{ route('customer.register.index') }}">
                                    <button
                                        type="button"
                                        class="theme-btn fs14 fw6">
                                        {{ __('velocity::app.header.sign-up') }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endguest

                @auth('customer')
                    <div class="modal-content customer-options">
                        <div class="customer-session">
                            <label class="">
                                {{ auth()->guard('customer')->user()->first_name }}
                            </label>
                        </div>

                        <ul type="none">
                            <li>
                                <a href="{{ route('customer.profile.index') }}" class="unset">{{ __('velocity::app.header.profile') }}</a>
                            </li>

                            <li>
                                <a href="{{ route('customer.orders.index') }}" class="unset">{{ __('velocity::app.shop.general.orders') }}</a>
                            </li>

                            @php
                                $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;

                                $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                            @endphp

                            @if ($showWishlist)
                                <li>
                                    <a href="{{ route('customer.wishlist.index') }}" class="unset">{{ __('velocity::app.header.wishlist') }}</a>
                                </li>
                            @endif

                            @if ($showCompare)
                                <li>
                                    <a href="{{ route('velocity.customer.product.compare') }}" class="unset">{{ __('velocity::app.customer.compare.text') }}</a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('customer.session.destroy') }}" class="unset">{{ __('velocity::app.header.logout') }}</a>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </script>

    <script type="text/javascript">

        Vue.component('login-header', {
            template: '#login-header-template',

            methods: {
                togglePopup: function (event) {
                    let accountModal = this.$el.querySelector('.account-modal');
                    let modal = $('#cart-modal-content')[0];

                    if (modal)
                        modal.classList.add('hide');

                    accountModal.classList.toggle('hide');

                    event.stopPropagation();
                }
            }
        })

    </script>
@endpush

