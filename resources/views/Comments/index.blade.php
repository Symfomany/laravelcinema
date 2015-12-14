@extends('layout')

@section('title')
    Commentaires
@endsection

@section('content')

@section('header')
    <h2><span class="text-light-gray">Films /</span> index</h2>
@endsection

<h2>Commentaires</h2>


<div class="stat-cell bg-success valign-middle col-md-4">
    <!-- Stat panel bg icon -->
    <i class="fa fa-pencil bg-icon"></i>
    <!-- Extra large text -->
    <span class="text-xlg"><strong>{{ $bestCommenter[0]->username }}</strong></span><br>
    <!-- Big text -->
    <span class="text-bg">a le plus commenté</span><br>
    <!-- Small text -->
    <span class="text-sm">({{ $bestCommenter[0]->nb_comments }} commentaires)</span>
</div>

<!-- Tableau -->
<div class="table table-light">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-comments" id="jq-datatables-example">
        <thead>
        <tr>
            <th>Id</th>
            <th>Film</th>
            <th>Contenu</th>
            <th>Favoris</th>
            <th>User</th>
            <th>Note</th>
            <th>Statut</th>
            <th>Date création</th>
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
                    {{ $comment->movie->title }}
                    {{-- Like --}}
                    <a class="like"
                       data-url="{{ route('movies.like') }}"
                       data-token="{{ csrf_token() }}"
                       data-action="like"
                       data-id="{{ $comment->movie->id }}">
                        <i class="fa fa-thumbs-o-up icon-space"></i>
                    </a>
                    <?php
                    if (session("moviesLike") !== NULL ) {
                        $count = array_count_values(session("moviesLike"));
                    }
                    ?>
                    <span class="label label-primary likeCounter">

                        @if (session("moviesLike") == NULL || !isset($count[$comment->movie->id]))
                            0
                        @else
                            {{ $count[$comment->movie->id] }}
                        @endif


                        </span>

                    {{-- Dislike --}}
                    <a href="#"><i class="fa fa-thumbs-o-down icon-space"></i></a>
                </td>


                <td>
                    <a class="bs-x-editable-comment"
                       data-pk="{{ $comment->id }}"
                       data-token="{{ csrf_token() }}"
                       data-url="{{ route('comments.update', ['id' => $comment->id]) }}">
                        {{--                           data-url="{{ route('comments.update', ['id' => $comment->id, 'value' => $comment->content]) }}">--}}
                        {{ $comment->content }}
                    </a>
                </td>
                <td>
                    <div id="switchers-colors-square" class="form-group-margin">
                        <input
                                data-token="{{ csrf_token() }}"
                                data-id="{{  $comment->id }}"
                                data-url="{{  route("comments.favoris") }}"
                                type="checkbox" data-class="switcher-warning" class="fav"
                                {{--@if(in_array($movie->id, session('favoris', [])))--}}
                                {{--checked--}}
                                {{--@endif--}}

                                >&nbsp;&nbsp;
                    </div>
                </td>

                {{-- A REMPLACER PAR LE NOM --}}
                <td> {{ $comment->user->username }}</td>

                <td> {{ $comment->note }} /5</td>
                <td> {{ $comment->state}}</td>
                <td> {{ $comment->date_created}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>



@endsection
