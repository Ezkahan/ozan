@extends('shop::customers.account.index')

@section('page_title')
    {{ __('velocity::app.customer.account.profile.index.title') }}
@endsection

@section('page-detail-wrapper')
    <div class="account-head mb-15">
        <span class="back-icon"><a href="{{ route('customer.account.index') }}"><i class="icon icon-menu-back"></i></a></span>
        <span class="account-heading">{{ __('velocity::app.customer.account.profile.index.title') }}</span>
        <span></span>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.before', ['customer' => $customer]) !!}

    <form
        method="POST"
        @submit.prevent="onSubmit"
        action="{{ route('customer.profile.store') }}">

        <div class="account-table-content">
            @csrf

            {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]) !!}

            <div :class="`row ${errors.has('first_name') ? 'has-error' : ''}`">
                <label class="col-12 mandatory">
                    {{ __('velocity::app.customer.account.profile.fname') }}
                </label>

                <div class="col-12">
                    <input value="{{ $customer->first_name }}" name="first_name" type="text" v-validate="'required'" />
                    <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                </div>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.profile.edit.first_name.after', ['customer' => $customer]) !!}

            <div class="row">
                <label class="col-12">
                    {{ __('velocity::app.customer.account.profile.lname') }}
                </label>

                <div class="col-12">
                    <input value="{{ $customer->last_name }}" name="last_name" type="text" />
                </div>
            </div>

            <div class="row">
                <label class="col-12">
                    {{ __('velocity::app.customer.account.profile.phone') }}
                </label>

                <div class="col-12">
                    <input value="{{ old('phone') ?? $customer->phone }}" name="phone" type="text"/>
                    <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                </div>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.profile.edit.phone.after', ['customer' => $customer]) !!}

            <div class="row">
                <label class="col-12">
                    {{ __('velocity::app.shop.general.enter-current-password') }}
                </label>

                <div :class="`col-12 ${errors.has('oldpassword') ? 'has-error' : ''}`">
                    <input value="" name="oldpassword" type="password" />
                </div>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.profile.edit.oldpassword.after', ['customer' => $customer]) !!}

            <div class="row">
                <label class="col-12">
                    {{ __('velocity::app.shop.general.new-password') }}
                </label>

                <div :class="`col-12 ${errors.has('password') ? 'has-error' : ''}`">
                    <input
                        value=""
                        name="password"
                        ref="password"
                        type="password"
                        v-validate="'min:6|max:18'" />

                    <span class="control-error" v-if="errors.has('password')">
                        @{{ errors.first('password') }}
                    </span>
                </div>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.profile.edit.password.after', ['customer' => $customer]) !!}

            <div class="row">
                <label class="col-12">
                    {{ __('velocity::app.shop.general.confirm-new-password') }}
                </label>

                <div :class="`col-12 ${errors.has('password_confirmation') ? 'has-error' : ''}`">
                    <input value="" name="password_confirmation" type="password"
                    v-validate="'min:6|confirmed:password'" data-vv-as="confirm password" />

                    <span class="control-error" v-if="errors.has('password_confirmation')">
                        @{{ errors.first('password_confirmation') }}
                    </span>
                </div>
            </div>

            @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                <div class="control-group">
                    <input type="checkbox" id="checkbox2" name="subscribed_to_news_letter" @if (isset($customer->subscription)) value="{{ $customer->subscription->is_subscribed }}" {{ $customer->subscription->is_subscribed ? 'checked' : ''}} @endif  style="width: auto;">
                    <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                </div>
            @endif

            {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.after', ['customer' => $customer]) !!}

            <button
                type="submit"
                class="theme-btn mb20">
                {{ __('velocity::app.shop.general.update') }}
            </button>
        </div>
    </form>

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.after', ['customer' => $customer]) !!}
@endsection