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
                       <i class="fa fa-area-chart"></i>  Répartitions des catégories pour les 5 meilleurs acteurs
                    </span>
                </div>
                <div class="panel-body pn">
                    <div class="stat-panel widget-support-tickets" id="dashboard-support-tickets">
                        <div class="panel-body tab-content-padding">
                            <div class="panel-padding no-padding-vr">
                                {{--<div id="stackedBar" class="graph"></div>--}}

                                                <div id="stackedBar" data-url="http://localhost:9000/admin/api/categories-best-actors" class="graph" style="position: relative;" data-highcharts-chart="1"><div class="highcharts-container" id="highcharts-2" style="position: relative; overflow: hidden; width: 577px; height: 400px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="577" height="400"><desc>Created with Highcharts 4.2.0</desc><defs><clipPath id="highcharts-3"><rect x="0" y="0" width="512" height="355"></rect></clipPath></defs><rect x="0" y="0" width="577" height="400" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"><path fill="none" d="M 55 365.5 L 567 365.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 306.5 L 567 306.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 247.5 L 567 247.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 188.5 L 567 188.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 128.5 L 567 128.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 69.5 L 567 69.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 55 9.5 L 567 9.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 156.5 365 L 156.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 259.5 365 L 259.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 361.5 365 L 361.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 464.5 365 L 464.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 567.5 365 L 567.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 54.5 365 L 54.5 375" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 55 365.5 L 567 365.5" stroke="#C0D0E0" stroke-width="1" zIndex="7"></path></g><g class="highcharts-axis" zIndex="2"><text x="23.890625" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 23.890625 187.5)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" y="187.5"><tspan>Nb de films</tspan></text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-series-0 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="59.5" width="50" height="119" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="128.5" y="178.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="230.5" y="237.5" width="50" height="118" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect><rect x="435.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#7cb5ec" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-0" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-1 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="178.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="128.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect><rect x="435.5" y="237.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#434348" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-1" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-2 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="178.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="128.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect><rect x="435.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-2" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-3 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="237.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="128.5" y="237.5" width="50" height="118" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="333.5" y="237.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect><rect x="435.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f7a35c" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-3" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-4 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="128.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="333.5" y="296.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect><rect x="435.5" y="296.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#8085e9" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-4" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g><g class="highcharts-series highcharts-series-5 highcharts-tracker" zIndex="0.1" transform="translate(55,10) scale(1 1)" style="" clip-path="url(#highcharts-3)"><rect x="26.5" y="296.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="128.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="230.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="333.5" y="296.5" width="50" height="59" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect><rect x="435.5" y="355.5" width="50" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect></g><g class="highcharts-markers highcharts-series-5" zIndex="0.1" transform="translate(55,10) scale(1 1)" clip-path="none"></g></g><g class="highcharts-legend" zIndex="7" transform="translate(51,15)"><rect x="0.5" y="0.5" width="505" height="38" strokeWidth="1" stroke="#CCC" stroke-width="1" fill="white" visibility="visible"></rect><g zIndex="1"><g><g class="highcharts-legend-item" zIndex="1" transform="translate(8,3)"><text x="21" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2" y="15"><tspan>Martin Freeman</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#7cb5ec"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(138.34375,3)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Christoph Waltz</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#434348"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(270.65625,3)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Richard Armitage</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#90ed7d"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(411.671875,3)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Jamie Foxx</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#f7a35c"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(8,17)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Tom Hanks</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#8085e9"></rect></g><g class="highcharts-legend-item" zIndex="1" transform="translate(113.671875,17)"><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2"><tspan>Series 6</tspan></text><rect x="0" y="4" width="16" height="12" zIndex="3" fill="#f15c80"></rect></g></g></g></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"><text x="106.2" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Fantastique</text><text x="208.60000000000002" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1"><tspan>Arts Martiaux</tspan></text><text x="311" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Aventure</text><text x="413.40000000000003" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Aventure/Actions</text><text x="515.8" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:92px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="384" opacity="1">Documentaire</text></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="370" opacity="1">0</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="311" opacity="1">1</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="252" opacity="1">2</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="193" opacity="1">3</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="133" opacity="1">4</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="74" opacity="1">5</text><text x="40" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:180px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="15" opacity="1">6</text></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;pointer-events:none;white-space:nowrap;" transform="translate(50,-9999)" opacity="0" visibility="visible"><path fill="none" d="M 3.5 0.5 L 111.5 0.5 C 114.5 0.5 114.5 0.5 114.5 3.5 L 114.5 57.5 C 114.5 60.5 114.5 60.5 111.5 60.5 L 62.5 60.5 56.5 66.5 50.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)" width="114" height="60"></path><path fill="none" d="M 3.5 0.5 L 111.5 0.5 C 114.5 0.5 114.5 0.5 114.5 3.5 L 114.5 57.5 C 114.5 60.5 114.5 60.5 111.5 60.5 L 62.5 60.5 56.5 66.5 50.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)" width="114" height="60"></path><path fill="none" d="M 3.5 0.5 L 111.5 0.5 C 114.5 0.5 114.5 0.5 114.5 3.5 L 114.5 57.5 C 114.5 60.5 114.5 60.5 111.5 60.5 L 62.5 60.5 56.5 66.5 50.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)" width="114" height="60"></path><path fill="rgba(249, 249, 249, .85)" d="M 3.5 0.5 L 111.5 0.5 C 114.5 0.5 114.5 0.5 114.5 3.5 L 114.5 57.5 C 114.5 60.5 114.5 60.5 111.5 60.5 L 62.5 60.5 56.5 66.5 50.5 60.5 3.5 60.5 C 0.5 60.5 0.5 60.5 0.5 57.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke="#7cb5ec" stroke-width="1"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" y="20"><tspan style="font-weight:bold">Fantastique</tspan><tspan x="8" dy="15">Martin Freeman: 2</tspan><tspan x="8" dy="15">Total: 5</tspan></text></g><text x="567" text-anchor="end" zIndex="8" style="cursor:pointer;color:#909090;font-size:9px;fill:#909090;" y="395">Highcharts.com</text></svg></div></div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="row">
        <div class="col-md-6">
            <div class="panel">

            <div class="stat-panel widget-support-tickets" id="dashboard-support-tickets">
                <!-- /.stat-row -->
                <div class="panel-body tab-content-padding">
                    <div class="panel-padding no-padding-vr">


                        <div class="data-chart hide" data-city="Atlanta" data-nb="3"></div>


                        <div class="data-chart hide" data-city="Birmingham" data-nb="2"></div>


                        <div class="data-chart hide" data-city="Chicago" data-nb="3"></div>


                        <div class="data-chart hide" data-city="London" data-nb="2"></div>


                        <div class="data-chart hide" data-city="Lyon" data-nb="3"></div>


                        <div class="data-chart hide" data-city="New York" data-nb="6"></div>


                        <div class="data-chart hide" data-city="Orlando" data-nb="3"></div>


                        <div class="data-chart hide" data-city="Sydney" data-nb="1"></div>


                        <div id="chart" style="height: 300px; position: relative;"><svg height="300" version="1.1" width="584" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="17.5" y="265" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M30,265H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="17.5" y="205" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2</tspan></text><path fill="none" stroke="#aaaaaa" d="M30,205H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="17.5" y="145" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4</tspan></text><path fill="none" stroke="#aaaaaa" d="M30,145H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="17.5" y="85" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">6</tspan></text><path fill="none" stroke="#aaaaaa" d="M30,85H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="17.5" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">8</tspan></text><path fill="none" stroke="#aaaaaa" d="M30,25H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="525.9375" y="277.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,5)"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Sydney</tspan></text><text x="393.6875" y="277.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,5)"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">New York</tspan></text><text x="261.4375" y="277.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,5)"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">London</tspan></text><text x="129.1875" y="277.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: sans-serif;" font-size="9px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,5)"><tspan dy="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Birmingham</tspan></text><rect x="38.265625" y="175" width="49.59375" height="90" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="104.390625" y="205" width="49.59375" height="60" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="170.515625" y="175" width="49.59375" height="90" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="236.640625" y="205" width="49.59375" height="60" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="302.765625" y="175" width="49.59375" height="90" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="368.890625" y="85" width="49.59375" height="180" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="435.015625" y="175" width="49.59375" height="90" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="501.140625" y="235" width="49.59375" height="30" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg>

                            <div class="morris-hover morris-default-style" style="left: 298.062px; top: 126px;"><div class="morris-hover-row-label">Lyon</div><div class="morris-hover-point" style="color: #0b62a4">
                                    value:
                                    3
                                </div></div></div>

                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-6">
            <div class="stat-panel widget-support-tickets" id="dashboard-support-tickets">
                <div class="stat-row">
                    <!-- Dark gray background, small padding, extra small text, semibold text -->
                    <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;Répartition des acteurs par âge
                    </div>
                </div> <!-- /.stat-row -->
                <div class="panel-body tab-content-padding">
                    <div class="panel-padding no-padding-vr">


                        <div class="data-donut hide" data-tranche="Entre 18 et 25" data-val="0"></div>


                        <div class="data-donut hide" data-tranche="Entre 25 et 35" data-val="14"></div>


                        <div class="data-donut hide" data-tranche="Entre 35 et 45" data-val="23"></div>


                        <div class="data-donut hide" data-tranche="Entre 45 et 60" data-val="41"></div>


                        <div class="data-donut hide" data-tranche="Plus de 60" data-val="23"></div>


                        <div id="donut" style="height:300px"><svg height="300" version="1.1" width="584" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.5px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#0b62a4" d="M292,243.33333333333331A93.33333333333333,93.33333333333333,0,0,0,296.9976087615237,243.19943678895197" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#0b62a4" stroke="#ffffff" d="M292,246.33333333333331A96.33333333333333,96.33333333333333,0,0,0,297.1582461860012,246.19513297145397L299.2286841014896,284.8063282125912A135,135,0,0,1,292,285Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#3980b5" d="M296.9976087615237,243.19943678895197A93.33333333333333,93.33333333333333,0,0,0,367.42199548758924,204.97848404404382" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#3980b5" stroke="#ffffff" d="M297.1582461860012,246.19513297145397A96.33333333333333,96.33333333333333,0,0,0,369.846273913976,206.74564960260238L401.09252918740583,229.52245013513482A135,135,0,0,1,299.2286841014896,284.8063282125912Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#679dc6" d="M367.42199548758924,204.97848404404382A93.33333333333333,93.33333333333333,0,0,0,357.46390744326027,83.47490749069672" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#679dc6" stroke="#ffffff" d="M369.846273913976,206.74564960260238A96.33333333333333,96.33333333333333,0,0,0,359.56810446822226,81.33660094575484L386.6888661232872,53.776205477614894A135,135,0,0,1,401.09252918740583,229.52245013513482Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#95bbd7" d="M357.46390744326027,83.47490749069672A93.33333333333333,93.33333333333333,0,0,0,199.67539313894622,163.68495813157529" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#95bbd7" stroke="#ffffff" d="M359.56810446822226,81.33660094575484A96.33333333333333,96.33333333333333,0,0,0,196.70781648984092,164.1248317858045L153.5130897084193,170.52743719736293A140,140,0,0,1,390.19586116489046,50.21236123604508Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#b0cce1" d="M199.67539313894622,163.68495813157529A93.33333333333333,93.33333333333333,0,0,0,291.9706784690489,243.333328727518" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#b0cce1" stroke="#ffffff" d="M196.70781648984092,164.1248317858045A96.33333333333333,96.33333333333333,0,0,0,291.96973599126835,246.3333285794739L291.9575884998743,284.9999933380171A135,135,0,0,1,158.45905079026147,169.79431444031425Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="292" y="140" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: 800; font-stretch: normal; font-size: 15px; line-height: normal; font-family: Arial;" font-size="15px" font-weight="800" transform="matrix(1.317,0,0,1.317,-92.5595,-47.0747)" stroke-width="0.7593005952380952"><tspan dy="5.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Entre 45 et 60 ans</tspan></text><text x="292" y="160" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 14px; line-height: normal; font-family: Arial;" font-size="14px" transform="matrix(1.9444,0,0,1.9444,-275.7704,-143.5556)" stroke-width="0.5142857142857143"><tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">41%</tspan></text></svg>

                        </div>

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