@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.forgot-password.page_title') }}
@stop

@push('css')
    <style>
        .button-group {
            margin-bottom: 25px;
        }

        .primary-back-icon {
            vertical-align: middle;
        }

    </style>
@endpush

@section('content-wrapper')
    <div class="register">
        <div class="auto__container">
            <div class="register__inner">


                {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

                <form method="post" action="{{ route('customer.forgot-password.store') }}" @submit.prevent="onSubmit">

                    {{ csrf_field() }}

                    <div class="google">

                        <div class="google__title">{{ __('shop::app.customer.forgot-password.title') }}</div>
                        <div class="google__column">
                            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}
                            <label for="email">{{ __('shop::app.customer.forgot-password.email') }}</label>
                            <div class="input__outer" :class="[errors.has('email') ? 'has-error' : '']">
                                <input type="email" class="control" name="email" v-validate="'required|email'">
                                <span class="input__error"
                                    v-if="errors.has('email')">@{{ errors . first('email') }}</span>
                            </div>
                        </div>


                        {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

                        <div class="button-group">
                            <button type="submit" class="register__btn btn-lg btn-primary">
                                {{ __('shop::app.customer.forgot-password.submit') }}
                            </button>
                        </div>

                        <div class="google__password-link" style="margin-bottom: 0px;">
                            <a href="{{ route('customer.session.index') }}">
                                <i class="icon primary-back-icon"></i>
                                {{ __('shop::app.customer.reset-password.back-link-title') }}
                            </a>
                        </div>

                    </div>
                </form>
            </div>
            {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}
        </div>
    </div>
@endsection
