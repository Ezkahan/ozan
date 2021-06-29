@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="register">
        <div class="auto__container">
            <div class="register__inner">
                <div class="register__text">
                    {{ __('shop::app.customer.login-text.no_account') }} - <a
                        href="{{ route('customer.register.index') }}">{{ __('shop::app.customer.login-text.title') }}</a>
                </div>

                {!! view_render_event('bagisto.shop.customers.login.before') !!}

                <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
                    {{ csrf_field() }}
                    <div class="google">
                        <div class="google__title">{{ __('shop::app.customer.login-form.title') }}</div>
                        <div class="google__column">
                            {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}
                            <label for="email" class="required">{{ __('shop::app.registerlogin.phoneNumber') }}</label>
                            <div class="input__outer" :class="[errors.has('phone') ? 'has-error' : '']">

                                <input type="text" class="control" name="phone" v-validate="'required|phone'"
                                    value="{{ old('phone') }}"
                                    data-vv-as="&quot;{{ __('shop::app.customer.login-form.phone') }}&quot;">
                            </div>
                        </div>
                        <div class="google__column">
                            <label for="password"
                                class="required">{{ __('shop::app.customer.login-form.password') }}</label>
                            <div class="input__outer" :class="[errors.has('password') ? 'has-error' : '']">

                                <input type="password" v-validate="'required|min:6'" class="control" id="password"
                                    name="password"
                                    data-vv-as="&quot;{{ __('admin::app.users.sessions.password') }}&quot;" value="" />
                            </div>
                        </div>


                        {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                        <div class="google__password-link">
                            <a
                                href="{{ route('customer.forgot-password.create') }}">{{ __('shop::app.customer.login-form.forgot_pass') }}</a>

                            <div class="mt-10">
                                @if (Cookie::has('enable-resend'))
                                    @if (Cookie::get('enable-resend') == true)
                                        <a
                                            href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <input class="register__btn btn-primary btn-lg sign_in-btn" type="submit"
                            value="{{ __('shop::app.customer.login-form.button_title') }}">
                    </div>

                </form>

                {!! view_render_event('bagisto.shop.customers.login.after') !!}
            </div>
        </div>
    </div>

@stop
