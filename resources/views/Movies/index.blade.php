{{--Héritage de ma vue mère--}}
@extends('layout')


@section('title')
   @parent  -  Liste de films
@endsection

{{--Ecriture dans mon content--}}
@section('content')
    <h3>Liste de film</h3>
@endsection

