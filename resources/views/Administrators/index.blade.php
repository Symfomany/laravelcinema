@extends('layout')


@section('famille')
    Gerer les administrateurs
@endsection

@section('content')

    <a href="{{ route('administrators_create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Ajouter un administrateur</a>
    <hr />
    <div class="panel">

        <div class="panel-heading">
            <h3>Gestion des administrateurs du site</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-primary table-responsive table-condensed">
                <thead>
                <tr>
                    <th>Id</th>
                    <th><i class="fa fa-envelope"></i> Email</th>
                    <th><i class="fa fa-user"></i>  Nom </th>
                    <th><i class="fa fa-image"></i>  Photo</th>
                    <th><i class="fa fa-cogs"></i>  Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($administrators as $administrator)
                    <tr>
                        <td>{{ $administrator->id }}</td>
                        <td>{{ $administrator->email }}</td>
                        <td>
                            {{ $administrator->firstname }}
                            {{ $administrator->lastname }}
                        </td>
                        <td class="img-responsive">
                            <img  src="{{ $administrator->photo }}"
                                  class="img-responsive col-md-3"
                                    />
                        </td>
                        <td>
                            <a href="{{ route('administrators_remove', ['id' => $administrator->id]) }}" class="btn btn-sm btn-danger">
                                <i class="fa fa-times"></i> Supprimer</a>
                            <a  href="{{ route('administrators_edit', ['id' => $administrator->id]) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil"></i> Editer</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection