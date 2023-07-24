@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="auth-content form-container">

        {!! view_render_event('bagisto.shop.customers.login.before') !!}

            <div class="container">
                <div class="col-lg-10 col-md-12 offset-lg-1">
                    <div class="heading">
                        <h2 class="fs24 fw6">
                            {{ __('velocity::app.customer.login-form.customer-login')}}
                        </h2>

                        <a href="{{ route('customer.register.index') }}" class="btn-new-customer">
                            <button type="button" class="theme-btn light">
                                {{ __('velocity::app.customer.login-form.sign-up')}}
                            </button>
                        </a>
                    </div>

                    <div class="body col-12">
                        <div class="form-header">
                            <h3 class="fw6">
                                {{ __('velocity::app.customer.login-form.registered-user')}}
                            </h3>

                            <p class="fs16">
                                {{ __('velocity::app.customer.login-form.form-login-text')}}
                            </p>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('customer.session.create') }}"
                            @submit.prevent="onSubmit">

                            {{ csrf_field() }}

                            <div class="input-group" :class="[errors.has('phone') ? 'has-error' : '']">

                                <label for="phone" class="required label-style">
                                    {{ __('shop::app.registerlogin.phoneNumber') }}
                                </label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">+993</span>
                                </div>
                                <input
                                    type="tel"

                                    class="form-control pl-2"
                                    name="phone"
                                    v-validate="'required|numeric|digits:8'"
                                    value="{{ old('phone') }}"
                                    data-vv-as="&quot;{{ __('velocity::app.customer.signup-form.phone') }}&quot;" />

                                <span class="control-error" v-if="errors.has('phone')">
                                @{{ errors.first('phone') }}
                            </span>
                            </div>
                            <div class="form-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password" class="mandatory label-style">
                                    {{ __('velocity::app.customer.login-form.password') }}
                                </label>

                                <input
                                    type="password"
                                    class="form-style"
                                    name="password"
                                    v-validate="'required'"
                                    value="{{ old('password') }}"
                                    data-vv-as="&quot;{{ __('velocity::app.customer.login-form.password') }}&quot;" />

                                <span class="control-error" v-if="errors.has('password')">
                                    @{{ errors.first('password') }}
                                </span>

                                <a href="{{ route('customer.forgot-password.create') }}" class="float-right">
                                    {{ __('velocity::app.customer.login-form.forgot_pass') }}
                                </a>

                                <div class="mt10">
                                    @if (Cookie::has('enable-resend'))
                                        @if (Cookie::get('enable-resend') == true)
                                            <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('velocity::app.customer.login-form.resend-verification') }}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="signup-confirm" :class="[errors.has('agreement') ? 'has-error' : '']">
                            <span class="checkbox">
                                <input type="checkbox" id="checkbox2" name="agreement" v-validate="'required'" data-vv-as="&quot;{{ __('velocity::app.customer.signup-form.agreement') }}&quot;">
                                <label class="checkbox-view" for="checkbox2"></label>
                                <span>{{ __('velocity::app.customer.signup-form.agree') }}
                                    <a href="{{route('shop.cms.page',['privacy-policy'])}}">{{ __('velocity::app.customer.signup-form.terms') }}</a>  <a href="{{route('shop.cms.page',['privacy-policy'])}}">{{ __('velocity::app.customer.signup-form.conditions') }}</a> {{ __('velocity::app.customer.signup-form.using') }}.
                                </span>
                            </span>
                                <span class="control-error" v-if="errors.has('agreement')">@{{ errors.first('agreement') }}</span>
                            </div>
                            {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                            <input class="theme-btn" type="submit" value="{{ __('velocity::app.customer.login-form.button_title') }}">

                        </form>
                    </div>
                </div>
            </div>

        {!! view_render_event('bagisto.shop.customers.login.after') !!}
    </div>
@endsection
