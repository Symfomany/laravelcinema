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
                
                <h1 class="coming-soon-title"> We're Getting Ready To Launch!</h1>
                <div class="panel panel-info bw10">

                        <!-- end .form-header section -->
                        <form method="post" action="/" id="contact">
                                <div class="panel-menu">
                                        <div class="row">
                                                <div class="col-md-9">
                                                        <label for="password" class="field prepend-icon">
                                                                <input type="text" name="password" id="password" class="gui-input" placeholder="Your Email Address">
                                                                <label for="password" class="field-icon">
                                                                        <i class="fa fa-envelope-o"></i>
                                                                </label>
                                                        </label>
                                                </div>
                                                <div class="col-md-3">
                                                        <button type="submit" class="button btn-info mr10 btn-block">Notify</button>
                                                </div>
                                        </div>
                                </div>
                                <!-- end .form-body section -->

                        </form>
                </div>
        </div>
@endsection