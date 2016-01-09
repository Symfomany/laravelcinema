{{--Héritage de ma vue mère--}}
@extends('layout')

@section('content')
        <h1>Liste des acteurs</h1>
        <table class="table table-bordered">
                <thead>
                <tr class="system">
                        <th class="sorting_asc">Id</th>
                        <th> Photo</th>
                        <th class="sorting_asc"> Nom / Prénom</th>
                        <th class="sorting_asc"> Ville</th>
                        <th class="sorting_asc"> Image</th>
                        <th class="sorting_asc"> Nationalité</th>
                        <th class="sorting_asc"> Roles</th>
                        <th class="sorting_asc"> Récompenses</th>
                        <th> Actions</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
@endsection