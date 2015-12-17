{{--Héritage de ma vue mère--}}
@extends('layout')

@section('js')
    @parent
    <script src="{{ asset('vendor/plugins/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/plugins/circles/circles.js') }}"></script>

    <script>
        $(document).ready(function(){

            // getJson en javascript
            // permet aller récupérer mes données en JSON
            // en passant par de l'AJAX
            // $.getJSON(url, fonctionderetour)
            $.getJSON("{{ route('api_categories') }}", function( data ) {

                // Pie Chart1
                $('#high-pie').highcharts({
                    credits: false,
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: null
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            center: ['30%', '50%'],
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    legend: {
                        x: 90,
                        floating: true,
                        verticalAlign: "middle",
                        layout: "vertical",
                        itemMarginTop: 10
                    },
                    series: [{
                        type: 'pie',
                        name: 'Nb de film par catégorie',
                        data: data
                    }]
                });

            });


        });
    </script>
@endsection

@section('content')



    <div class="row">

        <div class="col-md-3">

            <div class="panel panel-tile text-center br-a br-light">
                <div class="panel-body bg-light dark">
                    <h1 class="fs35 mbn">{{ $avgacteurs }} ans</h1>
                    <h6 class="text-system">Moyenne d'age des acteurs</h6>
                </div>
                <div class="panel-footer bg-white br-t br-light p12">
                                    <span class="fs11">
                                       <b>{{ $nbacteurs }}</b> acteurs
                                    </span>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="panel panel-tile text-center br-a br-light">
                <div class="panel-body bg-light dark">
                    <h1 class="fs35 mbn">{{ $avgnotecommentaire }} / 5</h1>
                    <h6 class="text-system">Moyenne des notes</h6>
                </div>
                <div class="panel-footer bg-white br-t br-light p12">
                            <span class="fs11">
                               <b>{{ $nbcommentaires }}</b> commentaires
                            </span>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="panel panel-tile text-center br-a br-light">
                <div class="panel-body bg-light dark">
                    <h1 class="fs35 mbn">{{ $avgnotepresse }} / 5</h1>
                    <h6 class="text-system">Moyenne de presse</h6>
                </div>
                <div class="panel-footer bg-white br-t br-light p12">
                            <span class="fs11">
                               <b>{{ $nbmovies }}</b> films
                            </span>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="panel panel-tile text-center br-a br-light">
                <div class="panel-body bg-light dark">
                    <h1 class="fs35 mbn">{{ $avghour }}h.</h1>
                    <h6 class="text-system">Moyenne des heures de diffusion</h6>
                </div>
                <div class="panel-footer bg-white br-t br-light p12">
                            <span class="fs11">
                               <b>{{ $nbseances }}</b> séances
                            </span>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <!-- Pie Chart -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title fw600 text-info">
                        <i class="fa fa-pie-chart"></i> Répartition des films par catégories
                    </span>
                </div>
                <div class="panel-body pn">
                    <div id="high-pie" style="position: relative; overflow: hidden; width: 369px; height: 210px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title fw600 text-info">
                       <i class="fa fa-chart"></i>  Répartitions des catégories pour les 5 meilleurs acteurs
                    </span>
                </div>
                <div class="panel-body pn">
            <div class="stat-panel widget-support-tickets" id="dashboard-support-tickets">
                <div class="stat-row">
                    <!-- Dark gray background, small padding, extra small text, semibold text -->
                    <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                        <i class="fa fa-globe"></i>&nbsp;&nbsp;Répartitions des catégories pour les 5 meilleurs acteurs
                    </div>
                </div> <!-- /.stat-row -->
                <div class="panel-body tab-content-padding">
                    <div class="panel-padding no-padding-vr">

                        <div id="stackedBar" data-url="http://localhost:9000/admin/api/categories-best-actors" class="graph" style="position: relative;" data-highcharts-chart="1"><div class="highcharts-container" id="highcharts-2" style="position: relative; overflow: hidden; width: 577px; height: 400px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="577" height="400"><desc>Created with Highcharts 4.2.0</desc><defs><clipPath id="highcharts-3"><rect x="0" y="0" width="512" height="355"></rect></clipPath></defs><rect x="0" y="0" width="577" height="400" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"><path fill="none" d="M 55 365.5 L 567 365.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 306.5 L 567 306.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 247.5 L 567 247.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 188.5 L 567 188.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 128.5 L 567 128.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 69.5 L 567 69.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 9.5 L 567 9.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 156.5 365 L 156.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 259.5 365 L 259.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 361.5 365 L 361.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 464.5 365 L 464.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 567.5 365 L 567.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 54.5 365 L 54.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 55 365.5 L 567 365.5" stroke="#C0D0E0" stroke-width="1" zIndex="7"></path></g><g class="highcharts-axis" zIndex="2"><text x="23.890625" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 23.890625 187.5)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" y="187.5"><tspan>Nb de films</tspan></text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-series-0 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="59.5" width="50" height="119" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="128.5" y="178.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="230.5" y="237.5" width="50" height="118" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="435.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-0" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-1 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="178.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="128.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="435.5" y="237.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-1" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-2 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="178.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="128.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="435.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-2" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-3 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="237.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="128.5" y="237.5" width="50" height="118" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="435.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-3" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-4 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="128.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="333.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="435.5" y="296.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-4" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-5 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="296.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="128.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="333.5" y="296.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="435.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-5" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g></g><g class="highcharts-legend" zIndex="7" transform="translate(51,15)"><rect x="0.5" y="0.5" width="505" height="38" strokeWidth="1" stroke="#CCC" stroke-width="1" fill="white" visibility="visible"></rect><g zIndex="1"><g><g class="highcharts-legend-item" zIndex="1" transform="translate(8,3)"><text x="21" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2" y="15"><tspan>Martin Freeman</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#7cb5ec"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(138.34375,3)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Christoph Waltz</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#434348"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(270.65625,3)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Richard Armitage</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#90ed7d"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(411.671875,3)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Jamie Foxx</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#f7a35c"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(8,17)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Tom Hanks</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#8085e9"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(113.671875,17)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Series 6</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#f15c80"></rect></g></g></g></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"><text x="106.2" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Fantastique</text><text x="208.60000000000002" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1"><tspan>Arts Martiaux</tspan></text><text x="311" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Aventure</text><text x="413.40000000000003" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Aventure/Actions</text><text x="515.8" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Documentaire</text></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="370" opacity="1">0</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="311" opacity="1">1</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="252" opacity="1">2</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="193" opacity="1">3</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="133" opacity="1">4</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="74" opacity="1">5</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="15" opacity="1">6</text></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;pointer-events:none;white-space:nowrap;" transform="translate(46,-9999)" opacity="0" visibility="visible"><path fill="none" d="M 3.5 0.5 L 119.5 0.5 C 122.5 0.5 122.5 0.5 122.5 3.5 L 122.5 57.5 C 122.5 60.5 122.5 60.5 119.5 60.5 L 66.5 60.5 60.5 66.5 54.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)" width="122" height="60"></path><path fill="none" d="M 3.5 0.5 L 119.5 0.5 C 122.5 0.5 122.5 0.5 122.5 3.5 L 122.5 57.5 C 122.5 60.5 122.5 60.5 119.5 60.5 L 66.5 60.5 60.5 66.5 54.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)" width="122" height="60"></path><path fill="none" d="M 3.5 0.5 L 119.5 0.5 C 122.5 0.5 122.5 0.5 122.5 3.5 L 122.5 57.5 C 122.5 60.5 122.5 60.5 119.5 60.5 L 66.5 60.5 60.5 66.5 54.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)" width="122" height="60"></path><path fill="rgba(249, 249, 249, .85)" d="M 3.5 0.5 L 119.5 0.5 C 122.5 0.5 122.5 0.5 122.5 3.5 L 122.5 57.5 C 122.5 60.5 122.5 60.5 119.5 60.5 L 66.5 60.5 60.5 66.5 54.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke="#90ed7d" stroke-width="1"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" y="20"><tspan style="font-weight:bold">Fantastique</tspan><tspan x="8" dy="15">Richard Armitage: 1</tspan><tspan x="8" dy="15">Total: 5</tspan></text></g><text x="567" text-anchor="end" zIndex="8" style="cursor:pointer;color:#909090;font-size:9px;fill:#909090;" y="395">Highcharts.com</text></svg></div></div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-8">
            <div class="panel listgroup-widget">
                <div class="panel-heading">
    <span class="panel-icon">
      <i class="fa fa-area-chart"></i>
    </span>
                    Nombres</span>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge badge-primary">14</span>
                        Films
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-success">9</span>
                        Catégories
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-info">11</span>
                        Acteurs
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning">18</span>
                        Réalisateurs
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-danger">22</span>
                        Séances
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-alert">9</span>
                        Médias
                    </li>
                </ul>
            </div>
        </div>


        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title"><i class="fa fa-wifi"></i> Distributeur</span>
                </div>
                <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr class="hidden">
                                <th>#</th>
                                <th>First Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Warner Bros</td>
                                <td>54%</td>
                            </tr>
                            <tr>
                                <td>
                                    HBO</td>
                                <td>17%</td>
                            </tr>
                            <tr>
                                <td>
                                    Century Fox</td>
                                <td>25%</td>
                            </tr>
                            <tr>
                                <td>
                                    Géode</td>
                                <td>25%</td>
                            </tr>
                            <tr>
                                <td>
                                    EuropaCorp</td>
                                <td>15%</td>
                            </tr>
                            <tr>
                                <td>
                                    Walt Disney </td>
                                <td>10%</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
            </div>
            </div>

        </div>






    <div class="row">
        <div class="col-md-6">

            <!-- User Group Widget -->
            <div class="panel user-group-widget">
                <div class="panel-heading">
                    <span class="panel-icon">
                      <i class="fa fa-users"></i>
                    </span>
                    <span class="panel-title">  {{ count($users) }} derniers utilisateurs</span>
                </div>
                <div class="panel-menu">
                    <div class="input-group ">
                      <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                      </span>
                        <input type="text" class="form-control" placeholder="Search user...">
                    </div>
                </div>
                <div class="panel-body panel-scroller pn scroller scroller-active" style="max-height: 513px;"><div class="scroller-bar" style="height: 512px;"><div class="scroller-track" style="height: 502px; margin-bottom: 5px; margin-top: 5px;"><div class="scroller-handle" style="height: 328.558px; top: 0px;"></div></div></div><div class="scroller-content">
                        <div class="row">
                            @foreach($users as $user)
                                <div class="col-md-3">
                                    <img src="{{ $user->avatar }}" class="user-avatar">
                                    <div class="caption">
                                        <h5>{{ $user->username }}
                                            <br>
                                            <small> {{ $user->ville }}</small>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div></div>
            </div>

        </div>


        <div class="col-md-6">

            <div class="bs-component">
                <div class="panel">
                    <div class="panel-heading">
                      <span class="panel-icon">
                        <i class="fa fa-clock-o"></i>
                      </span>
                        <span class="panel-title"> {{ count($seances) }} prochaines sessions</span>
                    </div>
                    <div class="panel-body ptn pbn p10">
                        <ol class="timeline-list">

                            @foreach($seances as $seance)
                                <li class="timeline-item">
                                    <div class="timeline-icon bg-dark light">
                                        <span class="fa fa-film"></span>
                                    </div>
                                    <div class="timeline-desc">
                                        <b>{{ $seance->mtitle }}</b> diffusé au
                                        <a href="#">{{ $seance->mcinema }}</a>
                                    </div>
                                    <div class="timeline-date">{{ $seance->date_session }}</div>
                                </li>
                            @endforeach


                        </ol>
                    </div>
                </div>
                <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>

        </div>


    </div>



@endsection