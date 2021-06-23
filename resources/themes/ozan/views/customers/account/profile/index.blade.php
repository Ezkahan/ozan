@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection

@section('content-wrapper')

    <div class="account">
        <div class="auto__container">
            <div class="account__inner">
                @include('shop::customers.account.partials.sidemenu')
                <div class="account__layout">

                    <div class="account__layout-head">

                        <span class="back-icon"><a href="{{ route('customer.profile.index') }}"><i
                                    class="icon icon-menu-back">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 256 256"
                                        style="enable-background:new 0 0 256 256;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <polygon
                                                    points="207.093,30.187 176.907,0 48.907,128 176.907,256 207.093,225.813 109.28,128 		" />
                                            </g>
                                        </g>
                                    </svg></i></a></span>

                        <span class="account-heading">{{ __('shop::app.customer.account.profile.index.title') }}</span>

                        <span class="account-action">
                            <a href="{{ route('customer.profile.edit') }}">
                                <svg height="492pt" viewBox="0 0 492.49284 492" width="492pt"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m304.140625 82.472656-270.976563 270.996094c-1.363281 1.367188-2.347656 3.09375-2.816406 4.949219l-30.035156 120.554687c-.898438 3.628906.167969 7.488282 2.816406 10.136719 2.003906 2.003906 4.734375 3.113281 7.527344 3.113281.855469 0 1.730469-.105468 2.582031-.320312l120.554688-30.039063c1.878906-.46875 3.585937-1.449219 4.949219-2.8125l271-270.976562zm0 0" />
                                    <path
                                        d="m476.875 45.523438-30.164062-30.164063c-20.160157-20.160156-55.296876-20.140625-75.433594 0l-36.949219 36.949219 105.597656 105.597656 36.949219-36.949219c10.070312-10.066406 15.617188-23.464843 15.617188-37.714843s-5.546876-27.648438-15.617188-37.71875zm0 0" />
                                </svg>
                            </a>
                        </span>

                        <div class="horizontal-rule"></div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]) !!}

                    <div class="account__layout-table" style="width: 50%;">
                        <table style="color: #5E5E5E;">
                            <tbody>
                                {!! view_render_event('bagisto.shop.customers.account.profile.view.table.before', ['customer' => $customer]) !!}
                                <tr>
                                    <td>{{ __('shop::app.customer.account.profile.fname') }}</td>
                                    <td>{{ $customer->first_name }}</td>
                                </tr>

                                {!! view_render_event('bagisto.shop.customers.account.profile.view.table.first_name.after', ['customer' => $customer]) !!}

                                <tr>
                                    <td>{{ __('shop::app.customer.account.profile.lname') }}</td>
                                    <td>{{ $customer->last_name }}</td>
                                </tr>

                                {!! view_render_event('bagisto.shop.customers.account.profile.view.table.last_name.after', ['customer' => $customer]) !!}

                                <tr>
                                    <td>{{ __('shop::app.customer.account.profile.gender') }}</td>
                                    <td>{{ __($customer->gender) }}</td>
                                </tr>

                                {!! view_render_event('bagisto.shop.customers.account.profile.view.table.gender.after', ['customer' => $customer]) !!}

                                <tr>
                                    <td>{{ __('shop::app.customer.account.profile.dob') }}</td>
                                    <td>{{ $customer->date_of_birth }}</td>
                                </tr>

                                {!! view_render_event('bagisto.shop.customers.account.profile.view.table.date_of_birth.after', ['customer' => $customer]) !!}

                                <tr>
                                    <td>{{ __('shop::app.customer.account.profile.email') }}</td>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                {!! view_render_event('bagisto.shop.customers.account.profile.view.table.after', ['customer' => $customer]) !!}

                                {{-- @if ($customer->subscribed_to_news_letter == 1)
                                <tr>
                                    <td> {{ __('shop::app.footer.subscribe-newsletter') }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('shop.unsubscribe', $customer->email) }}">{{ __('shop::app.subscription.unsubscribe') }} </a>
                                    </td>
                                </tr>
                            @endif --}}
                            </tbody>
                        </table>


                        {{-- <button type="submit" @click="showModal('deleteProfile')" class="btn btn-lg btn-primary mt-10">
                            {{ __('shop::app.customer.account.address.index.delete') }}
                        </button>

                        <form method="POST" action="{{ route('customer.profile.destroy') }}" @submit.prevent="onSubmit">
                            @csrf

                            <modal id="deleteProfile" :is-open="modalIds.deleteProfile">
                                <h3 slot="header">{{ __('shop::app.customer.account.address.index.enter-password') }}
                                </h3>

                                <div slot="body">
                                    <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                        <label for="password"
                                            class="required">{{ __('admin::app.users.users.password') }}</label>
                                        <input type="password" v-validate="'required|min:6|max:18'" class="control"
                                            id="password" name="password"
                                            data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;" />
                                        <span class="control-error"
                                            v-if="errors.has('password')">@{{ errors . first('password') }}</span>
                                    </div>

                                    <div class="page-action">
                                        <button type="submit" class="btn btn-lg btn-primary mt-10">
                                            {{ __('shop::app.customer.account.address.index.delete') }}
                                        </button>
                                    </div>
                                </div>
                            </modal>
                        </form> --}}
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]) !!}
                </div>
            </div>
        </div>



    </div>
@endsection
