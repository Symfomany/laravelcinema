{{--Héritage de ma vue mère--}}
@extends('layout')


@section('content')


    <div class="panel">
        <div class="panel-heading">
            <h3><i class="fa fa-shopping-cart"></i> Récapitulatif de votre panier</h3>
        <div>
        <div class="panel-body">
            <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Montant HT</th>
                        <th>Montant TTC</th>
                        <th>Quantité</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse(session('likes', []) as $like)
                            <?php $movie  = \App\Http\Models\Movies::find($like) ?>
                            <tr>
                                <td>{{ $movie->id }}</td>
                                <td><img src="{{ $movie->image }}" class="img-responsive col-md-5" /></td>
                                <td><a>{{ $movie->title }}</a></td>
                                <td>{{ str_limit(strip_tags($movie->description),250,'...') }}</td>
                                <td><i>{{ $movie->price }} €</i></td>
                                <td><b>{{ $movie->price * 1.19  }}€</b></td>
                                <td>1</td>
                                <td><a href="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Supprimer</a>
                                </td>
                            </tr>
                        @empty
                           <tr>
                               <div class="alert alert-danger">
                                   Plus de produits
                               </div>
                           </tr>
                        @endforelse
                    </tbody>

            </table>
        </div>

        <div class="panel-footer">
            <a href="{{ route('cart_checkout') }}" class="btn btn-lg btn-primary"><i class="fa fa-dollar"></i> Régler cette commande</a>
         </div>

    </div>


@endsection