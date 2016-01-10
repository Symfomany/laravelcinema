{{--Héritage de ma vue mère--}}
@extends('layout_logout')

@section('js')
        @parent
        <script src="{{ asset('vendor/plugins/countdown/jquery.plugin.min.js') }}"></script>
        <script src="{{ asset('vendor/plugins/countdown/jquery.countdown.min.js') }}"></script>
        <script type="text/javascript">
                jQuery(document).ready(function() {

                        "use strict";

                        // Init Countdown Plugin
                        var newYear = new Date();
                        newYear = new Date("December 24, 2015 23:59:00");
                        $('#counter').countdown({
                                until: newYear
                        });

                });
        </script>
@endsection
@section('content')
        <div class="admin-form theme-info" id="login1" style="margin-top: 6%;">

                <div id="counter" class="is-countdown">
                        <span class="countdown-row countdown-show3">
                                <span class="countdown-section">
                                        <span class="countdown-amount">0</span>
                                        <span class="countdown-period">Heures</span>
                                </span>
                                <span class="countdown-section">
                                        <span class="countdown-amount">0</span>
                                        <span class="countdown-period">Minutes</span>
                                </span>
                                <span class="countdown-section">
                                        <span class="countdown-amount">0</span>
                                        <span class="countdown-period">Secondes</span>
                                </span>
                        </span>
                </div>
                
                <h1 class="coming-soon-title"> We're Getting Ready To Learn Laravel 5!</h1>
                <div class=" bw10">
                        <img style="margin-left: 320px;" src="http://www.slagus.com/resources/platform_icons/laravel_logo.png">
                </div>
        </div>
@endsection