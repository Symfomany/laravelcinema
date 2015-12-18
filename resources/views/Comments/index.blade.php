@extends('layout')

@section('title')
    Commentaires
@endsection

@section('content')

@section('header')
    <h2><span class="text-light-gray">Films /</span> index</h2>
@endsection

<div class="panel">
    <div class="panel-heading">

        <h3><i class="fa fa-comments"></i> {{ count($comments) }} Commentaires</h3>
        <hr />

    </div>
    <div class="panel-body">

        <!-- Tableau -->
        <div class="table table-light">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-comments" id="jq-datatables-example">
                <thead>
                <tr>
                    <th>Id</th>
                    <th><i class="fa fa-film"></i> Film</th>
                    <th><i class="fa fa-file-text"></i> Contenu</th>
                    <th><i class="fa fa-user"></i> User</th>
                    <th><i class="fa fa-user"></i> Note</th>
                    <th><i class="fa fa-user"></i> Statut</th>
                    <th><i class="fa fa-user"></i> Date</th>
                    <th><i class="fa fa-user"></i> Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr class="
                    @if ($comment->state == 0)
                            alert-danger
                            @elseif ($comment->state ==1)
                            alert-warning
                        @else
                            alert-success
                        @endif">
                        <td>{{ $comment->id }}</td>
                        <td>
                            <a href="">{{ $comment->movies->title }}</a>
                        </td>
                        <td>
                            {{ $comment->content }}
                        </td>

                        {{-- A REMPLACER PAR LE NOM --}}
                        <td> <a href="">{{ $comment->user->username }}</a></td>

                        <td> {!! str_repeat("<i class='fa fa-star'></i>",$comment->note ) !!}</td>
                        <td>
                            @if($comment->state == 0)
                                <i class='fa fa-eye-slash'></i>
                            @elseif($comment->state == 1)
                                <i class='fa fa-hourglass-start'></i>
                            @else
                                <i class='fa fa-eye'></i>
                            @endif
                        </td>
                        <td>
                            <i class="badge badge-info"> {{ \Carbon\Carbon::cre("Y-m-d H:i:s",$comment->created_at)->diffForHumans() }}</i>

                        </td>
                        <td>

                            <a class="btn btn-xs btn-success"><i class="fa fa-star"></i>Ajouter en favoris</a> <br /><br />
                            <a class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Editer</a>
                            <a class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Supprimer</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
