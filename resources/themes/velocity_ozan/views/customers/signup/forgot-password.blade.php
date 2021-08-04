@extends('shop::layouts.master')

@section('page_title')
    {{ __('velocity::app.customer.forgot-password.page_title') }}
@endsection

@section('full-content-wrapper')
    <div class="auth-content form-container">
        <div class="container">
            <div class="col-lg-10 col-md-12 offset-lg-1">
                <div class="heading">
                    <h2 class="fs24 fw6">
                        {{ __('velocity::app.customer.forget-password.forgot-password')}}
                    </h2>

                    <a href="{{ route('customer.session.index') }}" class="btn-new-customer">
                        <button type="button" class="theme-btn light">
                            {{  __('velocity::app.customer.signup-form.login') }}
                        </button>
                    </a>
                </div>

                <div class="body col-12">
                    <h3 class="fw6">
                        {{ __('velocity::app.customer.forget-password.recover-password')}}
                    </h3>

                    <p class="fs16">
                        {{ __('velocity::app.customer.forget-password.recover-password-text')}}
                    </p>

                    {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

                    <form
                        method="post"
                        action="{{ route('customer.forgot-password.store') }}"
                        @submit.prevent="onSubmit">

                        {{ csrf_field() }}

                        {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}
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

                        {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.after') !!}

                        <button class="theme-btn" type="submit">
                            {{ __('velocity::app.customer.forgot-password.submit') }}
                        </button>
                    </form>

                    {!! view_render_event('bagisto.shop.customers.forget_password.after') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
