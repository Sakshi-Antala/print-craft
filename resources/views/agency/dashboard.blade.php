@extends('agency.app')
@section('body')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h3 class="card-title text-white">Products</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{(isset($product)?count($product):"0")}}</h2>
                                {{--<p class="text-white mb-0">Jan - March 2019</p>--}}
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-3">
                        <div class="card-body">
                            <h3 class="card-title text-white">Orders</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{(isset($order)?count($order):"0")}}</h2>
                                <p class="text-white mb-0">Jan - March 2019</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-line-chart"></i></span>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-3 col-sm-6">--}}
                    {{--<div class="card gradient-4">--}}
                        {{--<div class="card-body">--}}
                            {{--<h3 class="card-title text-white">Customer Satisfaction</h3>--}}
                            {{--<div class="d-inline-block">--}}
                                {{--<h2 class="text-white">99%</h2>--}}
                                {{--<p class="text-white mb-0">Jan - March 2019</p>--}}
                            {{--</div>--}}
                            {{--<span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-sm-6">--}}
                    {{--<div class="card gradient-2">--}}
                        {{--<div class="card-body">--}}
                            {{--<h3 class="card-title text-white">Net Profit</h3>--}}
                            {{--<div class="d-inline-block">--}}
                                {{--<h2 class="text-white">$ 8541</h2>--}}
                                {{--<p class="text-white mb-0">Jan - March 2019</p>--}}
                            {{--</div>--}}
                            {{--<span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Month Wise Orders</h4>
                            <div id="donutchart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Month Wise Revenue</h4>
                            <div id="chart_div"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- #/ container -->
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Orders'],
                @foreach($result as $value)
                ['{{$value['month']}}',     {{$value['ord']}}],
                @endforeach
//                ['Work',     11],
//                ['Eat',      2],
//                ['Commute',  2],
//                ['Watch TV', 2],
//                ['Sleep',    7]
            ]);

            var options = {
                title: 'Month Wise Orders',
                pieHole: 0.4,
                height: 400,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month (Year)',  'Revenue', 'orders'],
                 @foreach($result as $value)
                ['{{$value['month']}}', {{$value['amt']}},         {{$value['ord']}}],
                 @endforeach
//                ['Alfred Hitchcock (1935)', 8.4,         7.9],
//                ['Ralph Thomas (1959)',     6.9,         6.5],
//                ['Don Sharp (1978)',        6.5,         6.4],
//                ['James Hawes (2008)',      4.4,         6.2]
            ]);

            var options = {
                title: 'Month Wise Revenue',
                vAxis: {title: 'Amount'},
                isStacked: true,
                height: 400,
            };

            var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
@endsection