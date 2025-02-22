@extends('shop::customers.account.index')

@section('page_title')
    {{ __('velocity::app.customer.account.profile.index.title') }}
@endsection

@push('css')
    <style>
        .account-head {
            height: 50px;
        }
    </style>
@endpush


@section('page-detail-wrapper')
    <div class="account-head mb-0">
        <span class="back-icon">
            <a href="{{ route('customer.account.index') }}">
                <i class="icon icon-menu-back"></i>
            </a>
        </span>
        <span class="account-heading">
            {{ __('velocity::app.customer.account.profile.index.title') }}
        </span>

        <span class="account-action">
            <a href="{{ route('customer.profile.edit') }}" class="theme-btn light unset float-right">
                {{ __('velocity::app.customer.account.profile.index.edit') }}
            </a>
        </span>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]) !!}

    <div class="account-table-content profile-page-content">
        <div class="table">
            <table>
                <tbody>
                    {!! view_render_event(
                    'bagisto.shop.customers.account.profile.view.table.before', ['customer' => $customer])
                    !!}

                    <tr>
                        <td>{{ __('velocity::app.customer.account.profile.fname') }}</td>
                        <td>{{ $customer->first_name }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.first_name.after', ['customer' => $customer]) !!}

                    <tr>
                        <td>{{ __('velocity::app.customer.account.profile.lname') }}</td>
                        <td>{{ $customer->last_name }}</td>
                    </tr>


                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.date_of_birth.after', ['customer' => $customer]) !!}

                    <tr>
                        <td>{{ __('velocity::app.customer.account.profile.phone') }}</td>
                        <td>{{ $customer->phone }}</td>
                    </tr>

                    {!! view_render_event(
                    'bagisto.shop.customers.account.profile.view.table.after', ['customer' => $customer])
                    !!}
                </tbody>
            </table>
        </div>

        <button
            type="submit"
            class="theme-btn mb20" @click="showModal('deleteProfile')" >
            {{ __('velocity::app.customer.account.address.index.delete') }}
        </button>

        <form method="POST" action="{{ route('customer.profile.destroy') }}" @submit.prevent="onSubmit">
            @csrf

            <modal id="deleteProfile" :is-open="modalIds.deleteProfile">
                <h3 slot="header">{{ __('velocity::app.customer.account.address.index.enter-password') }}
                </h3>
                <i class="rango-close"></i>

                <div slot="body">
                    <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                        <label for="password" class="required">{{ __('admin::app.users.users.password') }}</label>
                        <input type="password" v-validate="'required|min:6|max:18'" class="control" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                    </div>

                    <div class="page-action">
                        <button type="submit"  class="theme-btn mb20">
                        {{ __('velocity::app.customer.account.address.index.delete') }}
                        </button>
                    </div>
                </div>
            </modal>
        </form>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]) !!}
@endsection