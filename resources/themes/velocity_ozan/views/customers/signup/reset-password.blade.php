@extends('shop::layouts.master')

@section('page_title')
 {{ __('shop::app.customer.reset-password.title') }}
@endsection

@section('full-content-wrapper')

<div class="auth-content">
    {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}
        <div class="auth-content form-container">
            <div class="container">
                <div class="col-lg-10 col-md-12 offset-lg-1">
                    <div class="heading">
                        <h2 class="fs24 fw6">
                            {{ __('velocity::app.customer.reset-password.title')}}
                        </h2>
                    </div>

                    <div class="body col-12">

                        {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

                        <form
                            method="POST"
                            @submit.prevent="onSubmit"
                            action="{{ route('customer.reset-password.store') }}">

                            {{ csrf_field() }}

                            <input type="hidden" name="phone" value="{{ $customer->phone }}">

                            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

                            <div :class="`form-group ${errors.has('token') ? 'has-error' : ''}`">
                                <label for="token" class="required label-style mandatory">
                                    {{ __('velocity::app.customer.verify.token') }}
                                </label>

                                <input
                                    id="token"
                                    type="text"
                                    name="token"
                                    class="form-style"
                                    value="{{ old('token') }}"
                                    v-validate="'required|numeric|digits:5'" />

                                <span class="control-error" v-if="errors.has('token')">
                                    @{{ errors.first('token') }}
                                </span>
                            </div>

                            <div :class="`form-group ${errors.has('password') ? 'has-error' : ''}`">
                                <label for="password" class="required label-style mandatory">
                                    {{ __('velocity::app.customer.reset-password.password') }}
                                </label>

                                <input
                                    ref="password"
                                    class="form-style"
                                    name="password"
                                    type="password"
                                    v-validate="'required|min:6'" />

                                <span class="control-error" v-if="errors.has('password')">
                                    @{{ errors.first('password') }}
                                </span>
                            </div>

                            <div :class="`form-group ${errors.has('confirm_password') ? 'has-error' : ''}`">
                                <label for="confirm_password" class="required label-style mandatory">
                                    {{ __('velocity::app.customer.reset-password.confirm-password') }}
                                </label>

                                <input
                                    type="password"
                                    class="form-style"
                                    name="password_confirmation"
                                    v-validate="'required|min:6|confirmed:password'" />

                                <span class="control-error" v-if="errors.has('confirm_password')">
                                    @{{ errors.first('confirm_password') }}
                                </span>
                            </div>

                            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.after') !!}

                            <button class="theme-btn" type="submit">
                                {{ __('velocity::app.customer.reset-password.submit-btn-title') }}
                            </button>
                        </form>


                        {!! view_render_event('bagisto.shop.customers.forget_password.after') !!}
                    </div>
                </div>
            </div>
        </div>
    {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}
</div>
@endsection