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
                        {{ __('velocity::app.customer.login-form.customer-login') }}
                    </h2>

                    <a href="{{ route('customer.register.index') }}" class="btn-new-customer">
                        <button type="button" class="theme-btn light">
                            {{ __('velocity::app.customer.login-form.sign-up') }}
                        </button>
                    </a>
                </div>

                <div class="body col-12">
                    <div class="form-header">
                        <h3 class="fw6">
                            {{ __('velocity::app.customer.login-form.sms_verification') }}
                        </h3>

                        <p class="fs16">
                            {{ __('velocity::app.customer.login-form.sms_verification_text') }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('customer.session.sms_verify') }}" @submit.prevent="onSubmit">

                        {{ csrf_field() }}

                        @error('sms_code_error')
                            <p class="has-error">{{ trans('shop::app.customer.login-form.sms_code_error') }}</p>
                        @enderror

                        <input type="hidden" name="phone" value={{ old('phone') }}>

                        <div class="form-group" :class="[errors.has('sms_code_error') ? 'has-error' : '']">
                            <label for="sms_code" class="mandatory label-style">
                                {{ __('velocity::app.customer.login-form.sms_code') }}
                            </label>

                            <input type="text" class="form-style" name="sms_code" v-validate="'required'"
                                value="{{ old('sms_code') }}"
                                data-vv-as="&quot;{{ __('velocity::app.customer.login-form.sms_code') }}&quot;" />

                            <span class="control-error" v-if="errors.has('sms_code')">
                                @{{ errors.first('sms_code') }}
                            </span>

                        </div>

                        {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                        <input class="theme-btn" type="submit"
                            value="{{ __('velocity::app.customer.login-form.confirm') }}">

                    </form>
                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.shop.customers.login.after') !!}
    </div>
@endsection
