@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')

    <div class="auth-content">
        <div class="sign-up-text">
            {{ __('shop::app.customer.login-text.no_account') }} - <a
                href="{{ route('customer.register.index') }}">{{ __('shop::app.customer.login-text.title') }}</a>
        </div>

        {!! view_render_event('bagisto.shop.customers.login.before') !!}

        <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
            {{ csrf_field() }}
            <div class="login-form">
                <div class="login-text">{{ __('shop::app.customer.login-form.title') }}</div>

                {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                @if ($errors->has('customer_not_found'))
                    <p class="has-error">Bagyslan bizde beyle agza yok.</p>
                @endif

                <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                    <label for="phone" class="required">{{ __('shop::app.customer.login-form.phone') }}</label>
                    <input type="text" class="control" name="phone" v-validate="'required|phone'"
                        value="{{ old('phone') }}"
                        data-vv-as="&quot;{{ __('shop::app.customer.login-form.phone') }}&quot;">
                    <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                </div>


                @if (session()->has('sms-verification'))
                    <div class="control-group" :class="[errors.has('sms_code_error') ? 'has-error' : '']">
                        <label for="sms_code" class="required">{{ __('shop::app.customer.login-form.sms_code') }}</label>
                        <input type="number" v-validate="'required'" class="control" id="sms_code" name="sms_code"
                            data-vv-as="&quot;{{ __('admin::app.users.sessions.sms_code') }}&quot;" value="" />
                        <span class="control-error" v-if="errors.has('sms_code')">@{{ errors.first('sms_code') }}</span>
                    </div>
                @endif

                {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                <input class="btn btn-primary btn-lg" type="submit"
                    value="{{ __('shop::app.customer.login-form.button_title') }}">
            </div>
        </form>

        {!! view_render_event('bagisto.shop.customers.login.after') !!}
    </div>

@stop
