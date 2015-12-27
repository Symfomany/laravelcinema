{{--Héritage de ma vue mère--}}
@extends('layout')

@section('content')
        <h1>Liste des categories</h1>

        <table class="table table-bordered table-striped table-primary table-responsive table-condensed">
                <thead>
                <tr class="system">
                        <th class="sorting_asc">Id</th>
                        <th class="sorting_asc"> Titre</th>
                        <th class="sorting_asc"> Nb films</th>
                        <th> Description</th>
                        <th> Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $categorie)
                        <tr>
                                <td>{{ $categorie->id }}</td>
                                <td>{{ $categorie->title }}</td>
                                <td><span class="badge">
                                        {{ count($categorie->movies) }}
                                     </span>
                                </td>
                                <td>{{ $categorie->description }}</td>
                        </tr>

                @endforeach
@endsection