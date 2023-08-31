@extends('shop::layouts.master')

@section('page_title')
    {{ __('velocity::app.customer.signup-form.page-title') }}
@endsection

@section('full-content-wrapper')
    <div class="auth-content form-container">
        <div class="container">
            <div class="col-lg-10 col-md-12 offset-lg-1">
                <div class="heading">
                    <h2 class="fs24 fw6">
                        {{ __('velocity::app.customer.signup-form.user-registration') }}
                    </h2>

                    <a href="{{ route('customer.session.index') }}" class="btn-new-customer">
                        <button type="button" class="theme-btn light">
                            {{ __('velocity::app.customer.signup-form.login') }}
                        </button>
                    </a>
                </div>

                <div class="body col-12">
                    <h3 class="fw6">
                        {{ __('velocity::app.customer.signup-form.become-user') }}
                    </h3>

                    <p class="fs16">
                        {{ __('velocity::app.customer.signup-form.form-sginup-text') }}
                    </p>

                    {!! view_render_event('bagisto.shop.customers.signup.before') !!}

                    <form method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit">

                        {{ csrf_field() }}

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                        <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                            <label for="first_name" class="required label-style">
                                {{ __('velocity::app.customer.signup-form.firstname') }}
                            </label>

                            <input type="text" class="form-style" name="first_name" v-validate="'required'"
                                value="{{ old('first_name') }}"
                                data-vv-as="&quot;{{ __('velocity::app.customer.signup-form.firstname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('first_name')">
                                @{{ errors.first('first_name') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.firstname.after') !!}

                        <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                            <label for="last_name" class="required label-style">
                                {{ __('velocity::app.customer.signup-form.lastname') }}
                            </label>

                            <input type="text" class="form-style" name="last_name" v-validate="'required'"
                                value="{{ old('last_name') }}"
                                data-vv-as="&quot;{{ __('velocity::app.customer.signup-form.lastname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('last_name')">
                                @{{ errors.first('last_name') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.lastname.after') !!}

                        <div class="input-group" :class="[errors.has('phone') ? 'has-error' : '']">

                            <label for="phone" class="required label-style">
                                {{ __('velocity::app.customer.signup-form.phone') }}
                            </label>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+993</span>
                            </div>
                            <input type="tel" class="form-control pl-2" name="phone"
                                v-validate="'required|numeric|digits:8'" value="{{ old('phone') }}"
                                data-vv-as="&quot;{{ __('velocity::app.customer.signup-form.phone') }}&quot;" />

                            <span class="control-error" v-if="errors.has('phone')">
                                @{{ errors.first('phone') }}
                            </span>
                        </div>

                        <div class="signup-confirm" :class="[errors.has('agreement') ? 'has-error' : '']">
                            <span class="checkbox">
                                <input type="checkbox" id="checkbox2" name="agreement" v-validate="'required'"
                                    data-vv-as="&quot;{{ __('velocity::app.customer.signup-form.agreement') }}&quot;">
                                <label class="checkbox-view" for="checkbox2"></label>
                                <span>{{ __('velocity::app.customer.signup-form.agree') }}
                                    <a
                                        href="{{ route('shop.cms.page', ['privacy-policy']) }}">{{ __('velocity::app.customer.signup-form.terms') }}</a>
                                    & <a
                                        href="{{ route('shop.cms.page', ['privacy-policy']) }}">{{ __('velocity::app.customer.signup-form.conditions') }}</a>
                                    {{ __('velocity::app.customer.signup-form.using') }}.
                                </span>
                            </span>
                            <span class="control-error" v-if="errors.has('agreement')">@{{ errors.first('agreement') }}</span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

                        <button class="theme-btn" type="submit">
                            {{ __('velocity::app.customer.signup-form.title') }}
                        </button>
                    </form>

                    {!! view_render_event('bagisto.shop.customers.signup.after') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
