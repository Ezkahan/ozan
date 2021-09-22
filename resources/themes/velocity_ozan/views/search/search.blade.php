@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

@extends('shop::layouts.master')

@section('page_title')
    {{ __('velocity::app.search.page-title') }}
@endsection

@push('css')
    <style type="text/css">
        .category-container {
            min-height: unset;
        }

        .toolbar-wrapper .col-4:first-child {
            display: none !important;
        }

        .toolbar-wrapper .col-4:last-child {
            right: 0;
            position: absolute;
        }


        @media only screen and (max-width: 992px) {
            .main-content-wrapper .vc-header {
                box-shadow: unset;
            }

             .toolbar-wrapper .col-4:last-child {
                left: 175px;
            }

            .toolbar-wrapper .sorter {
                left: 35px;
                position: relative;
            }

            .quick-view-btn-container,
            .rango-zoom-plus,
            .quick-view-in-list {
                display: none;
            }

        }
    </style>
@endpush
@section('content-wrapper')
    <h2 class="ml-5 mt-5 col-12 fs30 fw6">{{ __('velocity::app.search.result') }}
    @if (! $results)
        {{ __('velocity::app.search.no-results') }}
    @else
        @if ($results->isEmpty())
            {{ __('velocity::app.search.no-results') }}
        @else
            @if ($results->total() == 1)

                    {{ $results->total() }} {{ __('velocity::app.search.found-result') }}

            @else

                    {{ $results->total() }} {{ __('velocity::app.search.found-results') }}

            @endif

        @endif
    @endif
    </h2>
@endsection
@section('full-content-wrapper')
    <search-component></search-component>
@endsection

@push('scripts')
    <script type="text/x-template" id="image-search-result-component-template">
        <div class="image-search-result">
            <div class="searched-image">
                <img :src="searchedImageUrl" alt="search"/>
            </div>

            <div class="searched-terms">
                <h3 class="fw6 fs20 mb-4">
                    {{ __('velocity::app.search.analysed-keywords') }}
                </h3>

                <div class="term-list">
                    <a v-for="term in searched_terms" :href="'{{ route('shop.search.index') }}?term=' + term.slug">
                        @{{ term.name }}
                    </a>
                </div>
            </div>
        </div>
    </script>

    <script type="text/x-template" id="seach-component-template">
        <section class="search-container row category-container">
            @if (request('image-search'))
                <image-search-result-component></image-search-result-component>
            @endif

            @if ($results && $results->count())
                <div class="filters-container col-12">
                    @include ('shop::products.list.toolbar')
                </div>

                    @foreach ($results as $productFlat)
                        @if ($toolbarHelper->getCurrentMode() == 'grid')
                            @include('shop::products.list.card', ['product' => $productFlat->product])
                        @else
                            @include('shop::products.list.card', [
                                'list' => true,
                                'product' => $productFlat->product
                            ])
                        @endif
                    @endforeach

                    @include('ui::datagrid.pagination')
            @endif

        </section>
    </script>

    <script>
        Vue.component('search-component', {
            template: '#seach-component-template',
        });

        Vue.component('image-search-result-component', {
            template: '#image-search-result-component-template',

            data: function() {
                return {
                    searched_terms: [],
                    searchedImageUrl: localStorage.searchedImageUrl,
                }
            },

            created: function() {
                if (localStorage.searched_terms && localStorage.searched_terms != '') {
                    this.searched_terms = localStorage.searched_terms.split('_');

                    this.searched_terms = this.searched_terms.map(term => {
                        return {
                            name: term,
                            slug: term.split(' ').join('+'),
                        }
                    });
                }
            }
        });
    </script>
@endpush