@extends('shop::layouts.master')

@section('page_title')
    {{ __('velocity::app.customer.signup-form.page-title') }}
@endsection

@section('full-content-wrapper')
    <div class="register">
        <div class="auto__container">
            <div class="register__inner">

                <form method="post" action="{{ route('customer.check-phone') }}" @submit.prevent="onSubmit">

                    {{ csrf_field() }}
                    <input type="hidden" name="api_token" value="{{$customer->api_token}}">

                    <div class="google">

                        <div class="google__title">{{ __('velocity::app.customer.verify.title') }}</div>
                        <div class="google__column">
                            <label for="token">{{ __('velocity::app.customer.verify.token') }}</label>
                            <div class="input__outer" :class="[errors.has('token') ? 'has-error' : '']">
                                <input type="text" class="control" name="token" v-validate="'required|numeric'">
                                <span class="input__error"
                                      v-if="errors.has('token')">@{{ errors . first('token') }}</span>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="register__btn btn-lg btn-primary">
                                {{ __('velocity::app.customer.verify.submit') }}
                            </button>
                            <a href="{{ route('customer.resend.verification-sms',['api_token'=>$customer->api_token]) }}"
                               class="btn btn-success btn-new-customer align-self-end ml-5">
                                {{  __('velocity::app.customer.verify.resend') }}
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

