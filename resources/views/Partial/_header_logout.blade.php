<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@section('title') Panneau d'administration @show</title>
    <meta name="keywords" content="HTML5 Bootstrap 3 Admin Template UI Theme" />
    <meta name="description" content="AbsoluteAdmin - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="AbsoluteAdmin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @section('css')
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin-tools/admin-forms/css/admin-forms.min.css') }}">
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
    @show
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="external-page sb-l-c sb-r-c">
    <div id="main" class="animated fadeIn">
