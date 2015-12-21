{{--Héritage de ma vue mère--}}
@extends('layout')

@section('js')
    @parent
    <script src="{{ asset('vendor/plugins/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/plugins/circles/circles.js') }}"></script>
    <script src="{{ asset('vendor/plugins/pnotify/pnotify.js') }}"></script>
    <script>
        $(document).ready(function(){

            $('#create_movie').submit(function(e){

                // blockage du formulaire
                e.preventDefault();

                // requete AJAX
                $.ajax({
                    method: "POST",
                    url: $('#create_movie').attr('action'),
                    data: $('#create_movie').serialize()
                }).done(function(data){
                    new PNotify({
                        title: 'Film a été crée',
                        text: data + " a été crée",
                    });
                });

            });



            var infoCircle = $('.info-circle');
            if (infoCircle.length) {
                // Color Library we used to grab a random color
                // Store all circles
                var circles = [];
                infoCircle.each(function(i, e) {
                    var circle = Circles.create({
                        id: $(e).attr('id'),
                        value: $(e).attr('value'),
                        radius: $(e).width() / 2,
                        width: 14,
                        text: function(value) {
                            var title = $(e).attr('title');
                            if (title) {
                                return '<h2 class="circle-text-value">' + value + '</h2><p>' + title + '</p>'
                            }
                            else {
                                return '<h2 class="circle-text-value mb5">' + value + '</h2>'
                            }
                        }
                    });
                    circles.push(circle);
                });

                // Add debounced responsive functionality
                var rescale = function() {
                    infoCircle.each(function(i, e) {
                        var getWidth = $(e).width() / 2;
                        circles[i].updateRadius(
                                getWidth);
                    });
                    setTimeout(function() {
                        // Add responsive font sizing functionality
                        $('.info-circle').find('.circle-text-value').fitText(0.4);
                    },50);
                }
                var lazyLayout = _.debounce(rescale, 300);
                $(window).resize(lazyLayout);

            }






            $('#stackedBar').highcharts({
                chart: {
                    type: 'bar'
                },
                title: false,
                xAxis: {
                    categories: ['Fantastique', 'Science-Fiction', 'Aventure', 'Action', 'Drame']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nb. de films total'
                    }
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },
                series: [{
                    name: 'Martin Freeman',
                    data: [5, 3, 4, 7, 2]
                }, {
                    name: 'Tom Hanks    ',
                    data: [2, 2, 3, 2, 1]
                }, {
                    name: 'Jamie Foxx',
                    data: [3, 4, 4, 2, 5]
                }]
            });

            $.getJSON("{{ route('api_actors') }}", function( data ) {

                $('#high-column').highcharts({
                credits: false,
                chart: {
                    backgroundColor: 'transparent',
                    type: 'column',
                    padding: 0,
                    margin: 0,
                    marginTop: 10
                },
                legend: {
                    enabled: false
                },
                title: {
                    text: null
                },
                xAxis: {
                    lineWidth: 0,
                    tickLength: 0,
                    minorTickLength: 0,
                    title: {
                        text: null
                    },
                    labels: {
                        enabled: false
                    }
                },
                yAxis: {
                    gridLineWidth: 0,
                    title: {
                        text: null
                    },
                    labels: {
                        enabled: false
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} acteurs</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        groupPadding: 0.05,
                        pointPadding: 0.25,
                        borderWidth: 0
                    }
                },
                series: data
            });
            });



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

                <div class="panel" id="pchart7">
                    <div class="panel-heading">
                  <span class="panel-title text-info fw600">
                    <i class="fa fa-users"></i> Répartition des acteurs par villes</span>
                    </div>
                    <div class="panel-body pn">

                        <div id="high-column" style="width: 100%;height: 197px;"></div>
                    </div>
                </div>
            </div>


    </div>
    <div class="row">
        <div class="panel">
            <form id="create_movie" action="{{ route('ajax_movies') }}" method="post">

            <div class="panel-heading">Ajout de film</div>
            <div class="panel-body">

                    <div class="form-group">
                        <label for="">Titre</label>
                        <input name="title" class="form-control" placeholder="Votre titre">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea  name="description" class="form-control" placeholder="Votre description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Catégories</label>
                        <select name="categories_id" class="form-control">
                            @foreach(\App\Http\Models\Categories::all() as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                            @endforeach
                        </select>
                    </div>



            </div>
            <div class="panel-footer">
                <button class="btn btn-primary">
                    <i class="fa fa-pencil"></i> Créer un film</button>
            </div>


                {{ csrf_field() }}

            </form>

        </div>

    </div>
    <div class="row">

            <div class="col-md-6">
                <!-- Circle Stats -->
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title fw600 text-info"><i class="fa fa-comments"></i> Répartition des commentaires</span>
                        <div class="widget-menu pull-right mr10 hidden">
                        <span class="fs11 text-muted">
                          <i class="fa fa-circle text-warning fs12 pr5"></i></span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-info fs12 pr5"></i></span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-primary fs12 pr5"></i></span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb20 text-right">
                        <span class="fs11 text-muted">
                          <i class="fa fa-circle text-warning fs12 pr5"></i> Actifs</span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-info fs12 pr5"></i> En cours</span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-primary fs12 pr5"></i> Inactifs</span>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="info-circle" id="c1"  value="80" data-circle-color="primary"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-circle" id="c2"  value="30" data-circle-color="info"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-circle" id="c3"  value="55" data-circle-color="warning"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title fw600 text-info"><i class="fa fa-line-chart"></i> Répartition des films</span>
                        <div class="widget-menu pull-right mr10 hidden">
                        <span class="fs11 text-muted">
                          <i class="fa fa-circle text-warning fs12 pr5"></i></span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-info fs12 pr5"></i></span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-primary fs12 pr5"></i></span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb20 text-right">
                        <span class="fs11 text-muted">
                          <i class="fa fa-circle text-warning fs12 pr5"></i> Actifs</span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-info fs12 pr5"></i> En cours</span>
                        <span class="fs11 text-muted ml10">
                          <i class="fa fa-circle text-primary fs12 pr5"></i> Inactifs</span>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="info-circle" id="c4"  value="40" data-circle-color="primary"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-circle" id="c5"  value="20" data-circle-color="info"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-circle" id="c6"  value="15" data-circle-color="warning"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title fw600 text-info">
                       <i class="fa fa-area-chart"></i>  Répartitions des catégories pour les 3 meilleurs acteurs
                    </span>
                </div>
                <div class="panel-body pn">
                    <div class="stat-panel widget-support-tickets" id="dashboard-support-tickets">
                        <div class="panel-body tab-content-padding">
                            <div class="panel-padding no-padding-vr">
                                <div id="stackedBar" class="graph"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

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