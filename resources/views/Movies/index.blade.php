{{--Héritage de ma vue mère--}}
@extends('layout')

@section('famille')
    Movies
@endsection

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
@endsection

@section('js')
    @parent

    <script src="{{ asset('vendor/plugins/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function(){

            $('table').dataTable({
                "language": {
                    "lengthMenu": "Afficher _MENU_ par page",
                    "sSearch":        "Rechercher:",
                    "zeroRecords": "Aucun résultat trouvé",
                    "info": "Voir la page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucun résultat disponible",
                    "infoFiltered": "(filtré sur _MAX_ resultats)"
                }
            });

        })
    </script>
@endsection

@section('title')
    @parent  -  Liste de films
@endsection

{{--Ecriture dans mon content--}}
@section('content')
    <div class="col-md-12">

    <h3>
        <i class="fa fa-file-movie-o"></i> Liste de <i>{{  count($movies) }} films</i>

        <a href="{{ route('movies_create') }}" class="btn btn-primary btn-sm pull-right">
            <i class="fa fa-plus"></i> Créer un film
        </a>

    </h3>

    <div class="panel panel-visible" id="spy2">
        <div class="panel-body pn">
                    <table class="table table-bordered table-striped table-primary table-responsive table-condensed">
                        <thead>
                        <tr class="system">
                            <th class="sorting_asc">Id</th>
                            <th> Photo</th>
                            <th class="sorting_asc"> Titre</th>
                            <th class="sorting_asc"> Catégorie</th>
                            <th class="sorting_asc"> Equipe</th>
                            <th class="sorting_asc"> Acteurs</th>
                            <th> Description</th>
                            <th> Visible</th>
                            <th> Date</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movies as $movie)
                            <tr>
                                <td>{{ $movie->id }}

                                    @if(!in_array($movie->id, session('likes', [])))

                                    <a href="{{ route('movies_like', [
                                        'id' => $movie->id,
                                        'action' => 'like'
                                    ]) }}">
                                        <span class="fa fa-heart"></span>
                                    </a>
                                    @else
                                        <a href="{{ route('movies_like', [
                                        'id' => $movie->id,
                                        'action' => 'dislike'
                                    ]) }}">
                                            <span class="fa fa-heart-o"></span>
                                        </a>
                                    @endif


                                </td>
                                <td><img src="{{ $movie->image }}" class="img-responsive col-md-10" /></td>
                                <td><a href="">{{ $movie->title }}</a></td>
                                <td><a href="">{{ $movie->categories->title }}</a></td>
                                <td>
                                    <p>
                                        <span class="badge badge-default">
                                            {{ count($movie->actors) }}
                                        </span> acteurs
                                    </p>
                                    <p>
                                        <span class="badge badge-default">
                                            {{ count($movie->directors) }}
                                        </span> réas </p>
                                    <p>
                                        <span class="badge badge-default">
                                            {{ count($movie->comments) }}</span>
                                        comms </p>
                                </td>
                                <td>
                                    <ul>
                                    @foreach($movie->actors as $actor)
                                        <li >
                                            {{ $actor->firstname }} {{ $actor->lastname }}
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td>{{ str_limit(strip_tags($movie->description),250,'...') }}</td>
                                <td>
                                    @if($movie->cover == 1)
                                        <a href="{{  route('movies_cover', ['id' => $movie->id]) }}" class="btn btn-primary">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    @else
                                        <a href="{{  route('movies_cover', ['id' => $movie->id]) }}" class="btn btn-danger">
                                            <i class="fa fa-star-o"></i>
                                        </a>
                                    @endif

                                    @if($movie->visible == 1)
                                        <a href="{{ route('movies_activate', ['id' => $movie->id ]) }}" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('movies_activate', ['id' => $movie->id ]) }}" class="btn btn-danger">
                                            <i class="fa fa-eye-slash"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{  \Carbon\Carbon::createFromFormat('Y-m-d', $movie->date_release)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route("movies_edit", ['id' => $movie->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editer</a>
                                    <a href="{{ route('movies_delete', ['id' => $movie->id ]) }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i> Supprimer
                                    </a>
                                    <a class="btn btn-sm btn-success"><i class="fa fa-search"></i> Voir</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

