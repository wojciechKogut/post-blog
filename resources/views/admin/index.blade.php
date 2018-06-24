@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Cards</li>
            </ol>
            <hr>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Area Chart Example</div>
            <div class="card-body">
                <script type="text/javascript">
                    google.charts.load('current', {'packages': ['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        // Create the data table.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Topping');
                        data.addColumn('number', 'Count');
                        data.addRows([
                            ['Posts', {{$posts->count()}}],
                            ['Users', {{$users->count()}}],
                            ['Categories',{{$categories->count()}}],
                            ['Comments', {{$comments->count()}}],
                            ['Users', {{$users->count()}}],
                            ['Subscribers', {{$sub->count()}}],
                            ['Admins', {{$adm->count()}}],
                            ['Active users', {{$active->count()}}]
                        ]);
                        // Set chart options
                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };
                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
                        chart.draw(data, options);
                    }
                </script>     
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                <!--<canvas id="myAreaChart" width="100%" height="30"></canvas>-->
            </div>
        </div>
@endsection