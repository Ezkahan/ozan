@extends('shop::layouts.master')

@section('page_title')
    {{ __('velocity::app.reviews.add-review-page-title') }} - {{ $product->name }}
@endsection

@section('full-content-wrapper')

    <div class="container">
        <section class="row review-page-container">
            @include ('shop::products.view.small-view', ['product' => $product])

            <div class="col-lg-6 col-md-12">
                <div class="row customer-rating col-12 remove-padding-margin">
                    <h2 class="full-width">
                        {{ __('velocity::app.reviews.write-review') }}
                    </h2>

                    <form
                        method="POST"
                        class="review-form"
                        @submit.prevent="onSubmit"
                        action="{{ route('shop.reviews.store', $product->product_id ) }}">

                        @csrf

                        <div :class="`${errors.has('rating') ? 'has-error' : ''}`">
                            <label for="title" class="required">
                                {{ __('velocity::app.reviews.ratings') }}
                            </label>
                            <star-ratings ratings="5" size="24" editable="true"></star-ratings>
                            <span :class="`control-error ${errors.has('rating') ? '' : 'hide'}`" v-if="errors.has('rating')">
                                @{{ errors.first('rating') }}
                            </span>
                        </div>

                        <div :class="`${errors.has('title') ? 'has-error' : ''}`">
                            <label for="title" class="required">
                                {{ __('velocity::app.reviews.title') }}
                            </label>
                            <input
                                type="text"
                                name="title"
                                class="control"
                                v-validate="'required'"
                                value="{{ old('title') }}" />

                            <span :class="`control-error ${errors.has('title') ? '' : 'hide'}`">
                                @{{ errors.first('title') }}
                            </span>
                        </div>

                        @if (core()->getConfigData('catalog.products.review.guest_review') && ! auth()->guard('customer')->user())
                            <div :class="`${errors.has('name') ? 'has-error' : ''}`">
                                <label for="title" class="required">
                                    {{ __('velocity::app.reviews.name') }}
                                </label>
                                <input  type="text" class="control" name="name" v-validate="'required'" value="{{ old('name') }}">
                                <span :class="`control-error ${errors.has('name') ? '' : 'hide'}`">
                                    @{{ errors.first('name') }}
                                </span>
                            </div>
                        @endif

                        <div :class="`${errors.has('comment') ? 'has-error' : ''}`">
                            <label for="comment" class="required">
                                {{ __('velocity::app.reviews.comment') }}
                            </label>
                            <textarea
                                type="text"
                                class="control"
                                name="comment"
                                v-validate="'required'"
                                value="{{ old('comment') }}">
                            </textarea>
                            <span :class="`control-error ${errors.has('comment') ? '' : 'hide'}`">
                                @{{ errors.first('comment') }}
                            </span>
                        </div>

                        <div class="submit-btn">
                            <button
                                type="submit"
                                class="theme-btn fs16">
                                {{ __('velocity::app.products.submit-review') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($showRecentlyViewed)
                @include ('shop::products.list.recently-viewed', [
                    'addClass' => 'col-lg-3 col-md-12'
                ])
            @endif
        </section>
    </div>

@endsection
