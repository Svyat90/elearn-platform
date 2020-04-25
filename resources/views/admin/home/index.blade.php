@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="{{ $settings1['column_class'] }}">
                                <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $settings1['chart_title'] }}</span>
                                        <span class="info-box-number">{{ number_format($settings1['total_number']) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="{{ $settings2['column_class'] }}">
                                <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $settings2['chart_title'] }}</span>
                                        <span class="info-box-number">{{ number_format($settings2['total_number']) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="{{ $settings3['column_class'] }}">
                                <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $settings3['chart_title'] }}</span>
                                        <span class="info-box-number">{{ number_format($settings3['total_number']) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="{{ $settings4['column_class'] }}">
                                <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $settings4['chart_title'] }}</span>
                                        <span class="info-box-number">{{ number_format($settings4['total_number']) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="end_section1"></div>

                            <div class="{{ $chart5_day->options['column_class'] }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="width: 50%;float: left">
                                            <h3>
                                                {!! $chart5_day->options['chart_title'] !!}
                                            </h3>
                                        </div>
                                        <div style="width: 50%;float: left">
                                            <div class="form-group pull-right">
                                                <select name="" id="" class="form-control sale_bar_count">
                                                    <option value="day">Daily</option>
                                                    <option value="week">Weekly</option>
                                                    <option value="month">Monthly</option>
                                                    <option value="year">Yearly</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                    </div>
                                </div>
                                <div class="sale_bar_count_day sale_bar_count_chart">
                                    {!! $chart5_day->renderHtml() !!}
                                </div>
                                <div class="sale_bar_count_week sale_bar_count_chart">
                                    {!! $chart5_week->renderHtml() !!}
                                </div>
                                <div class="sale_bar_count_month sale_bar_count_chart">
                                    {!! $chart5_month->renderHtml() !!}
                                </div>
                                <div class="sale_bar_count_year sale_bar_count_chart">
                                    {!! $chart5_year->renderHtml() !!}
                                </div>
                            </div>
                            <div class="{{ $chart5_amount_day->options['column_class'] }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="width: 50%;float: left">
                                            <h3>
                                                {!! $chart5_amount_day->options['chart_title'] !!}
                                            </h3>
                                        </div>
                                        <div style="width: 50%;float: left">
                                            <div class="form-group pull-right">
                                                <select name="" id="" class="form-control sale_bar_amount">
                                                    <option value="day">Daily</option>
                                                    <option value="week">Weekly</option>
                                                    <option value="month">Monthly</option>
                                                    <option value="year">Yearly</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                    </div>
                                </div>
                                <div class="sale_bar_amount_day sale_bar_amount_chart">
                                    {!! $chart5_amount_day->renderHtml() !!}
                                </div>
                                <div class="sale_bar_amount_week sale_bar_amount_chart">
                                    {!! $chart5_amount_week->renderHtml() !!}
                                </div>
                                <div class="sale_bar_amount_month sale_bar_amount_chart">
                                    {!! $chart5_amount_month->renderHtml() !!}
                                </div>
                                <div class="sale_bar_amount_year sale_bar_amount_chart">
                                    {!! $chart5_amount_year->renderHtml() !!}
                                </div>
                            </div>
                            <div class="end_section2"></div>

                            {{-- Widget - latest entries --}}
                            <div class="{{ $settings7['column_class'] }}" style="overflow-x: auto;">
                                <h3>{{ $settings7['chart_title'] }}</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        @foreach($settings7['fields'] as $key => $value)
                                            <th>
                                                {{ ucfirst($key) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($settings7['data'] as $entry)
                                        <tr>
                                            @foreach($settings7['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ $entry->{$key}->{$value} }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($settings7['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- Widget - latest entries --}}
                            <div class="{{ $settings8['column_class'] }}" style="overflow-x: auto;">
                                <h3>{{ $settings8['chart_title'] }}</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        @foreach($settings8['fields'] as $key => $value)
                                            <th>
                                                {{ ucfirst($key) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($settings8['data'] as $entry)
                                        <tr>
                                            @foreach($settings8['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ $entry->{$key}->{$value} }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($settings8['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- Widget - latest entries --}}
                            <div class="{{ $settings9['column_class'] }}" style="overflow-x: auto;">
                                <h3>{{ $settings9['chart_title'] }}</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        @foreach($settings9['fields'] as $key => $value)
                                            <th>
                                                {{ ucfirst($key) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($settings9['data'] as $entry)
                                        <tr>
                                            @foreach($settings9['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ $entry->{$key}->{$value} }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($settings9['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="end_section3"></div>

                            <div class="{{ $settings10['column_class'] }}">
                                <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $settings10['chart_title'] }}</span>
                                        <span class="info-box-number">{{ number_format($settings10['total_number']) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="{{ $settings11['column_class'] }}">
                                <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $settings11['chart_title'] }}</span>
                                        <span class="info-box-number">{{ number_format($settings11['total_number']) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="{{ $settings12['column_class'] }}">
                                <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $settings12['chart_title'] }}</span>
                                        <span class="info-box-number">{{ number_format($settings12['total_number']) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .end_section1,
        .end_section2,
        .end_section3
        {
            margin-top: 25px;
            clear: both;
            display: block;
            width: 100%;
        }
    </style>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    {!! $chart5_day->renderJs() !!}
    {!! $chart5_week->renderJs() !!}
    {!! $chart5_month->renderJs() !!}
    {!! $chart5_year->renderJs() !!}

    {!! $chart5_amount_day->renderJs() !!}
    {!! $chart5_amount_week->renderJs() !!}
    {!! $chart5_amount_month->renderJs() !!}
    {!! $chart5_amount_year->renderJs() !!}

    {{--{!! $chart6->renderJs() !!}--}}

    <script>
        $(function () {
            $('.sale_bar_count_chart').hide();
            $('.sale_bar_count_day').show();
            $( ".sale_bar_count" ).change(function() {
                $('.sale_bar_count_chart').hide();
                $('.sale_bar_count_'+$(this).val()).show();
            });
            // amount
            $('.sale_bar_amount_chart').hide();
            $('.sale_bar_amount_day').show();
            $( ".sale_bar_amount" ).change(function() {
                $('.sale_bar_amount_chart').hide();
                $('.sale_bar_amount_'+$(this).val()).show();
            });
        });

    </script>
@endsection