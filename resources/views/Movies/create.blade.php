{{--Héritage de ma vue mère--}}
@extends('layout')

@section('content')
        <h1>Creation de film</h1>
        <form action="{{ route('movies_store') }}" method="post">

            <label for="title">Titre</label>
            <input placeholder="Votre contenu..." name="title" id="id">

            <textarea placeholder="Votre contenu..." name="desc">

            </textarea>
            {{ csrf_field() }}

            <button type="submit">Enregistrer ce film</button>

        </form>

@endsection