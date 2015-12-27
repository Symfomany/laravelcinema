{{--Héritage de ma vue mère--}}
@extends('layout')


@section('content')


    <div class="panel">
        <div class="panel-heading">
            <h3><i class="fa fa-check"></i> Confirmation de paiment</h3>
        <div>
        <div class="panel-body">
            <div class="alert alert-success"><i class="fa fa-check"></i>  Paiment effectué :)</div>
            <a href="{{ route('movies_index') }}">Retour vers les films</a>
        </div>
    </div>


@endsection