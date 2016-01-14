{{--Héritage de ma vue mère--}}
@extends('layout')

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/magnific/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/slick/slick.css') }}" />
@endsection


@section('js')
    @parent
    <script src="{{ asset('vendor/plugins/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/plugins/circles/circles.js') }}"></script>
    <script src="{{ asset('vendor/plugins/pnotify/pnotify.js') }}"></script>
    <script src="{{ asset('vendor/plugins/c3charts/d3.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/fullcalendar/lib/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/magnific/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('vendor/plugins/slick/slick.js') }}"></script>

    <script>

    </script>
    <script>
        $(document).ready(function(){



            $('.center-mode').slick({
                dots: true,
                centerMode: false,
                autoplay: true,
                centerPadding: '60px',
                slidesToShow: 7,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }]
            });

            // Init FullCalendar external events
            $('#external-events .fc-event').each(function() {
                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true, // maintain when user navigates (see docs on the renderEvent method)
                    className: 'fc-event-' + $(this).attr('data-event') // add a contextual class name from data attr
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });

            var Calendar = $('#calendar');
            var Picker = $('.inline-mp');

            // Init FullCalendar Plugin
            Calendar.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: [{
                    title: 'Sony Meeting',
                    start: '2015-12-5',
                    end: '2015-12-8',
                    className: 'fc-event-success',
                }, {
                    title: 'Conference',
                    start: '2016-01-14',
                    end: '2016-01-16',
                    className: 'fc-event-warning'
                }, {
                    title: 'Conference 2 ',
                    start: '2016-01-10',
                    end: '2016-01-15',
                    className: 'fc-event-warning'
                },  {
                    title: 'System Testing',
                    start: '2016-01-26',
                    end: '2016-01-18',
                    className: 'fc-event-primary'
                },
                ],
                viewRender: function(view) {
                    // If monthpicker has been init update its date on change
                    if (Picker.hasClass('hasMonthpicker')) {
                        var selectedDate = Calendar.fullCalendar('getDate');
                        var formatted = moment(selectedDate, 'MM-DD-YYYY').format('MM/YY');
                        Picker.monthpicker("setDate", formatted);
                    }
                    // Update mini calendar title
                    var titleContainer = $('.fc-title-clone');
                    if (!titleContainer.length) {
                        return;
                    }
                    titleContainer.html(view.title);
                },
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function() {
                    // is the "remove after drop" checkbox checked?
                    if (!$(this).hasClass('event-recurring')) {
                        $(this).remove();
                    }
                },
                eventRender: function(event, element) {
                    // create event tooltip using bootstrap tooltips
                    $(element).attr("data-original-title", event.title);
                    $(element).tooltip({
                        container: 'body',
                        delay: {
                            "show": 100,
                            "hide": 200
                        }
                    });
                    // create a tooltip auto close timer
                    $(element).on('show.bs.tooltip', function() {
                        var autoClose = setTimeout(function() {
                            $('.tooltip').fadeOut();
                        }, 3500);
                    });
                }
            });




            // Init Calendar Modal via "inline" Magnific Popup
            $('#compose-event-btn').magnificPopup({
                removalDelay: 500, //delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function(e) {
                        // we add a class to body indication overlay is active
                        // We can use this to alter any elements such as form popups
                        // that need a higher z-index to properly display in overlays
                        $('body').addClass('mfp-bg-open');
                        this.st.mainClass = this.st.el.attr('data-effect');
                    },
                    afterClose: function(e) {
                        $('body').removeClass('mfp-bg-open');
                    }
                },
                midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
            });

            // Calendar Modal Date picker
            $("#eventDate").datepicker({
                numberOfMonths: 1,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                showButtonPanel: false,
                beforeShow: function(input, inst) {
                    var newclass = 'admin-form';
                    var themeClass = $(this).parents('.admin-form').attr('class');
                    var smartpikr = inst.dpDiv.parent();
                    if (!smartpikr.hasClass(themeClass)) {
                        inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                    }
                }

            });


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

            c3.generate({
                bindto: '#donut-chart',
                data: {
                    columns: [
                        ['data1', 30],
                        ['data2', 120],
                    ],
                    type : 'donut',
                    onclick: function (d, i) { console.log("onclick", d, i); },
                    onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                    onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                },
                donut: {
                    title: "Répartition d'âge des acteurs"
                }
            });

            var infoCircle = $('.info-circle');
            if (infoCircle.length) {
                // Color Library we used to grab a random color
                // Store all circles
                var circles = [];
                infoCircle.each(function(i, e) {
                    var circle = Circles.create({
                        colors:              ['#D3B6C6', '#4B253A'],
                        id: $(e).attr('id'),
                        width: 25,
                        value: $(e).attr('value'),
                        radius: $(e).width() / 2,
                        text: function(value) {
                            var title = $(e).attr('title');
                            if (title) {
                                return '<h2 class="circle-text-value">' + value + '%</h2><p>' + title + '</p>'
                            }
                            else {
                                return '<h2 class="circle-text-value mb5">' + value + '%</h2>'
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
        <div class="col-md-4">
            <div class="panel">
                <form id="create_movie" action="{{ route('ajax_movies') }}" method="post" >

                    <div class="stat-row panel-heading text-info">
                        <i class="fa fa-film"></i> Ajout de film
                    </div>
                    <div class="panel-body admin-form">

                        <div class="form-group">
                            <label for="">Titre</label>
                            <input name="title" class="form-control" placeholder="Votre titre">
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <label class="field prepend-icon">
                                <textarea name="description" placeholder="Votre description" class="gui-textarea" id="comment" name="trailer"></textarea>
                                <label for="comment" class="field-icon">
                                    <i class="fa fa-pencil"></i>
                                </label>
                                        <span class="input-footer">
                                          <strong>Exemple:</strong> Synopsis du film ...
                                        </span>
                            </label>
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
        <div class="col-md-4">
            <div class="panel stat-panel widget-support-tickets" id="dashboard-support-tickets">
                <div class="stat-row panel-heading">
                    <!-- Dark gray background, small padding, extra small text, semibold text -->
                    <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold text-info">
                        <i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Répartition des acteurs par âge
                    </div>
                </div> <!-- /.stat-row -->
                <div class="panel-body tab-content-padding">
                    <div class="panel-padding no-padding-vr">

                        <div id="donut-chart" style="height:300px"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel listgroup-widget">
                <div class="panel-heading">
                    <span class="panel-icon">
                      <i class="fa fa-youtube"></i>
                    </span>
                    <span class="panel-title">Statistiques de Youtube</span>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">

                        <h3><span class="fa fa-youtube-play"></span><b> {{ $youtubeinfo->snippet->title  }}</b></h3>
                    </li>
                    <li class="list-group-item">
                        <p class="row">
                            <img class="pull-right" src="{{ $youtubeinfo->snippet->thumbnails->default->url  }}" />
                            {{ $youtubeinfo->snippet->description  }}
                        </p>
                    </li>

                    <li class="list-group-item">
                                            <span class="badge badge-primary">
                                                {{ $youtubeinfo->statistics->viewCount  }}
                                            </span>
                        Nombre de vues

                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-success">{{ $youtubeinfo->statistics->commentCount  }}</span>
                        Nombre de commentaires
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-info">{{ $youtubeinfo->statistics->subscriberCount  }}</span>
                        Nombre de membres
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning">{{ $youtubeinfo->statistics->videoCount  }}</span>
                        Nombre de vidéo
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel">
            <div class="stat-row panel-heading">
                <!-- Dark gray background, small padding, extra small text, semibold text -->
                <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold text-info">
                    <i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Films de @Allocine
                </div>
            </div>
            <div class="panel-body">


                <div class="slider-demo7">
                    <div class="center-mode">
                        @foreach($videos as $video)
                            <div class="slick-slide">
                                <a href="https://www.youtube.com/watch?v={{ $video->data->id->videoId }}" target="_blank">
                                    <img src="{{ $video->data->snippet->thumbnails->default->url }}" />
                                </a>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr class="clear" />


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
        </div>


        <div class="col-md-6">
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



    </div>
    <div class="row">

        <div class="col-md-6">

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title fw600 text-info"><i class="fa fa-calendar"></i> Calendrier des séances</span>
                </div>
                <div class="panel-body">
                    <div id="calendar" class="admin-theme fc fc-ltr fc-unthemed"></div>
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

        <div class="col-md-4">
            <div class="panel listgroup-widget">
                <div class="panel-heading text-info">
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
                    <span class="panel-title text-info"><i class="fa fa-film"></i> Film aléatoire: <b>{{ str_limit($video->data->snippet->title,100,'...') }}</b></span>
                </div>
                <div class="panel-body border">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src="https://www.youtube.com/embed/{{ str_replace('"', "", $video->data->id->videoId) }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title text-info"><i class="fa fa-wifi"></i> Distributeur</span>
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
                    <span class="panel-title text-info">  {{ count($users) }} derniers utilisateurs</span>
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
                        <span class="panel-title text-info"> {{ count($seances) }} prochaines sessions</span>
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