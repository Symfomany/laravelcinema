@extends('layout_logout')


@section('title')
    Authentification
@endsection

@section('bodyclass')
    external-page external-alt sb-l-c sb-r-c
    @endsection

    @section('content')
            <!-- Begin: Content -->
    <section id="content">

        <div class="admin-form theme-info mw500" id="login">

            <!-- Login Logo -->
            <div class="row table-layout">
                <a href="dashboard.html" title="Return to Dashboard">
                    <img src="{{ asset('assets/img/logos/logo.png') }}" title="AdminDesigns Logo" class="center-block img-responsive" style="max-width: 275px;">
                </a>
            </div>

            <!-- Login Panel/Form -->
            <div class="panel mt30 mb25">

                <form method="post"  id="contact">
                    <div class="panel-body bg-light p25 pb15">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                                    <!-- Social Login Buttons -->
                            <div class="section row">
                                <div class="col-md-6">
                                    <a href="#" class="button btn-social facebook span-left btn-block">
                      <span>
                        <i class="fa fa-facebook"></i>
                      </span>Facebook</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="button btn-social googleplus span-left btn-block">
                      <span>
                        <i class="fa fa-google-plus"></i>
                      </span>Google+</a>
                                </div>
                                <div class="col-md-6 hidden">
                                    <a href="#" class="button btn-social twitter span-left btn-block">
                      <span>
                        <i class="fa fa-twitter"></i>
                      </span>Twitter</a>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="section-divider mv30">
                                <span>OR</span>
                            </div>

                            <!-- Username Input -->
                            <div class="section">
                                <label for="email" class="field-label text-muted fs18 mb10">Email</label>
                                <label for="email" class="field prepend-icon">
                                    <input type="email" name="email" id="email" class="gui-input" placeholder="Email ou username">
                                    <label for="username" class="field-icon">
                                        <i class="fa fa-envelope"></i>
                                    </label>
                                </label>
                            </div>

                            <!-- Password Input -->
                            <div class="section">
                                <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                                <label for="password" class="field prepend-icon">
                                    <input type="password" name="password" id="password" class="gui-input" placeholder="Mot de passe">
                                    <label for="password" class="field-icon">
                                        <i class="fa fa-lock"></i>
                                    </label>
                                </label>
                            </div>
                    </div>

                    <div class="panel-footer clearfix">
                        <button type="submit" class="button btn-primary mr10 pull-right">Connexion</button>
                        <label class="switch ib switch-primary mt10">
                            <input type="checkbox" name="remember" id="remember" checked>
                            <label for="remember" data-on="YES" data-off="NO"></label>
                            <span>Remember me</span>
                        </label>
                    </div>
                    {{ csrf_field() }}

                </form>
            </div>

            <!-- Registration Links -->
            <div class="login-links">

                <p>Nouvel administrateur sur la plateforme?
                    <a href="{{ url('auth/register') }}" title="Sign In">Je m'enregistre ici</a>
                </p>
            </div>

            <!-- Registration Links(alt) -->
            <div class="login-links hidden">
                <a href="pages_login-alt.html" class="active" title="Sign In">Sign In</a> |
                <a href="{{ url('auth/register') }}" class="" title="Register">Register</a>
            </div>

        </div>

    </section>
    <!-- End: Content -->


@endsection