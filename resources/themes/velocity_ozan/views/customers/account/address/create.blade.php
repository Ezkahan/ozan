@extends('shop::customers.account.index')

@section('page_title')
    {{ __('velocity::app.customer.account.address.create.page-title') }}
@endsection

@section('page-detail-wrapper')
    <div class="account-head mb-15">
        <span class="back-icon"><a href="{{ route('customer.account.index') }}"><i class="icon icon-menu-back"></i></a></span>
        <span class="account-heading">{{ __('velocity::app.customer.account.address.create.title') }}</span>
        <span></span>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.address.create.before') !!}

        <form method="post" action="{{ route('customer.address.store') }}" @submit.prevent="onSubmit">

            <div class="account-table-content">
                @csrf

                <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                    <label for="first_name" class="mandatory">{{ __('velocity::app.customer.account.address.create.first_name') }}</label>
                    <input type="text" class="control" name="first_name" value="{{ old('first_name') }}" v-validate="'required'" data-vv-as="&quot;{{ __('velocity::app.customer.account.address.create.first_name') }}&quot;">
                    <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.first_name.after') !!}

                <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                    <label for="last_name" class="mandatory">{{ __('velocity::app.customer.account.address.create.last_name') }}</label>
                    <input type="text" class="control" name="last_name" value="{{ old('last_name') }}" v-validate="'required'" data-vv-as="&quot;{{ __('velocity::app.customer.account.address.create.last_name') }}&quot;">
                    <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.last_name.after') !!}


                {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.vat_id.after') !!}

                @php
                    $addresses = explode(PHP_EOL, (old('address1') ?? ''));
                @endphp

                <div class="control-group" :class="[errors.has('address1[]') ? 'has-error' : '']">
                    <label for="address_0" class="mandatory">{{ __('velocity::app.customer.account.address.create.street-address') }}</label>
                    <input type="text" class="control" name="address1[]" id="address_0" value="{{ $addresses[0] ?: '' }}" v-validate="'required'" data-vv-as="&quot;{{ __('velocity::app.customer.account.address.create.street-address') }}&quot;">
                    <span class="control-error" v-if="errors.has('address1[]')">@{{ errors.first('address1[]') }}</span>
                </div>

                @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                    @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                        <div class="control-group" style="margin-top: -25px;">
                            <input type="text" class="control" name="address1[{{ $i }}]" id="address_{{ $i }}" value="{{ $addresses[$i] ?? '' }}">
                        </div>
                    @endfor
                @endif

                <div class="control-group" :class="[errors.has('city') ? 'has-error' : '']">
                    <label for="city" class="mandatory">{{ __('velocity::app.customer.account.address.create.city') }}</label>
                    <input type="text" class="control" name="city" value="{{ old('city') }}" v-validate="'required'" data-vv-as="&quot;{{ __('velocity::app.customer.account.address.create.city') }}&quot;">
                    <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.postcode.after') !!}

                <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                    <label for="phone" class="mandatory">{{ __('velocity::app.customer.account.address.create.phone') }}</label>
                    <input type="text" class="control" name="phone" value="{{ old('phone') }}" v-validate="'required'" data-vv-as="&quot;{{ __('velocity::app.customer.account.address.create.phone') }}&quot;">
                    <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.after') !!}

                <div class="button-group">
                    <button class="theme-btn" type="submit">
                        {{ __('velocity::app.customer.account.address.create.submit') }}
                    </button>
                </div>
            </div>
        </form>

    {!! view_render_event('bagisto.shop.customers.account.address.create.after') !!}
@endsection