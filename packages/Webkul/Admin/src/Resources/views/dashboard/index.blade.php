@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.dashboard.title') }}
@stop

@section('content-wrapper')

    <div class="content full-page dashboard">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.dashboard.title') }}</h1>
            </div>

            <div class="page-action">
                <date-filter></date-filter>
            </div>
        </div>

        <div class="page-content">

            <div class="dashboard-stats">

                <div class="dashboard-card">
                    <div class="title">
                        {{ __('admin::app.dashboard.total-customers') }}
                    </div>

                    <div class="data">
                        {{ $statistics['total_customers']['current'] }}

                        <span class="progress">
                            @if ($statistics['total_customers']['progress'] < 0)
                                <span class="icon graph-down-icon"></span>
                                {{ __('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['total_customers']['progress'], 1)
                                    ])
                                }}
                            @else
                                <span class="icon graph-up-icon"></span>
                                {{ __('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['total_customers']['progress'], 1)
                                    ])
                                }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="title">
                        {{ __('admin::app.dashboard.total-orders') }}
                    </div>

                    <div class="data">
                        {{ $statistics['total_orders']['current'] }}

                        <span class="progress">
                            @if ($statistics['total_orders']['progress'] < 0)
                                <span class="icon graph-down-icon"></span>
                                {{ __('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['total_orders']['progress'], 1)
                                    ])
                                }}
                            @else
                                <span class="icon graph-up-icon"></span>
                                {{ __('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['total_orders']['progress'], 1)
                                    ])
                                }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="title">
                        {{ __('admin::app.dashboard.total-sale') }}
                    </div>

                    <div class="data">
                        {{ core()->formatBasePrice($statistics['total_sales']['current']) }}

                        <span class="progress">
                            @if ($statistics['total_sales']['progress'] < 0)
                                <span class="icon graph-down-icon"></span>
                                {{ __('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['total_sales']['progress'], 1)
                                    ])
                                }}
                            @else
                                <span class="icon graph-up-icon"></span>
                                {{ __('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['total_sales']['progress'], 1)
                                    ])
                                }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="title">
                        {{ __('admin::app.dashboard.average-sale') }}
                    </div>

                    <div class="data">
                        {{ core()->formatBasePrice($statistics['avg_sales']['current']) }}

                        <span class="progress">
                            @if ($statistics['avg_sales']['progress'] < 0)
                                <span class="icon graph-down-icon"></span>
                                {{ __('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['avg_sales']['progress'], 1)
                                    ])
                                }}
                            @else
                                <span class="icon graph-up-icon"></span>
                                {{ __('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['avg_sales']['progress'], 1)
                                    ])
                                }}
                            @endif
                        </span>
                    </div>
                </div>

            </div>


        </div>
    </div>

@stop

@push('scripts')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

    <script type="text/x-template" id="date-filter-template">
        <div>
            <div class="control-group date">
                <date @onChange="applyFilter('start', $event)" hide-remove-button="1"><input type="text" class="control" id="start_date" value="{{ $startDate->format('Y-m-d') }}" placeholder="{{ __('admin::app.dashboard.from') }}" v-model="start"/></date>
            </div>

            <div class="control-group date">
                <date @onChange="applyFilter('end', $event)" hide-remove-button="1"><input type="text" class="control" id="end_date" value="{{ $endDate->format('Y-m-d') }}" placeholder="{{ __('admin::app.dashboard.to') }}" v-model="end"/></date>
            </div>
        </div>
    </script>

    <script>
        Vue.component('date-filter', {

            template: '#date-filter-template',

            data: function() {
                return {
                    start: "{{ $startDate->format('Y-m-d') }}",
                    end: "{{ $endDate->format('Y-m-d') }}",
                }
            },

            methods: {
                applyFilter: function(field, date) {
                    this[field] = date;

                    window.location.href = "?start=" + this.start + '&end=' + this.end;
                }
            }
        });

        $(document).ready(function () {

            var ctx = document.getElementById("myChart").getContext('2d');

            var data = @json($statistics['sale_graph']);

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['label'],
                    datasets: [{
                        data: data['total'],
                        backgroundColor: 'rgba(34, 201, 93, 1)',
                        borderColor: 'rgba(34, 201, 93, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            maxBarThickness: 20,
                            gridLines : {
                                display : false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 20,
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, dataTemp) {
                                return data['formated_total'][tooltipItem.index];
                            }
                        }
                    }
                }
            });
        });
    </script>

@endpush