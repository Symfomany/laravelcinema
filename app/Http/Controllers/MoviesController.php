<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;


use App\Http\Models\Movies;
use App\Http\Requests\MoviesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


/**
 * Class MainController
 * @package App\Http\Controllers
 * Sufficé par le mot clef Controller
 * et doit hérité de la super classe Controller
 */
class MoviesController extends Controller{

    /**
     * Page Acceuil
     */
    public function index(){

        // je crée un obet de mon model Movies
        $movies = Movies::all();

        // le transporteur:
        // je transporte mes données du Controlleur
        // à la vue
        return view('Movies/index',[
                'movies' => $movies
            ]
        );
    }

    /**
     * Page Create
     */
    public function create(){

        // vue
        return view('Movies/create');
    }


    /**
     * Page Read
     */
    public function read($id){

        // vue
        return view('Movies/read');
    }
    /**
     * Page Read
     */
    public function edit($id){

        // vue
        return view('Movies/edit');
    }


    /**
     * Action qui va me permettre d'activer un film
     * @param $id
     */
    public function activate($id){
        // find() permet de retourner un Objet Movie
        // depuis son id
        $movie = Movies::find($id);

        if($movie->visible == 0){
            $movie->visible = 1;
            Session::flash("success",
                "Le film {$movie->title} a bien été activé");

        }
        else{
            $movie->visible = 0;
            Session::flash("success",
                "Le film {$movie->title} a bien été desactivé");
        }

        // save() permet de sauvegarder
        // mon objet modifié en BDD
        $movie->save();

        return Redirect::route('movies_index');

    }


    /**
     * Action qui va me permettre de metter en avant un film
     * @param $id
     */
    public function cover($id){
        // find() permet de retourner un Objet Movie
        // depuis son id
        $movie = Movies::find($id);

        if($movie->cover == 0){
            $movie->cover = 1;
            Session::flash("success",
                "Le film {$movie->title} a bien été mis en avant");

        }
        else{
            $movie->cover = 0;
            Session::flash("danger",
                "Le film {$movie->title} a bien été retiré de l'avant");
        }

        // save() permet de sauvegarder
        // mon objet modifié en BDD
        $movie->save();

        return Redirect::route('movies_index');

    }



    /**
     * Suppresion
     */
    public function delete($id){

        // Un objet film depuis son ID
        $movie = Movies::find($id);

        // si le film n'existe plus
        if($movie){

            // Créer un message flash de type "success"
            Session::flash('success', "Le film {$movie->title} a bien été supprimé");

            // delete() permete de supprimer un objet en
            // base de données

            $movie->delete();
        }




        //redirection vers mes films
        return Redirect::route('movies_index');
    }



    /**
     * Action d'enregistrement en base de données
     * depuis mon formulaire
     * Classe Request permet de réceptionner les données
     * en POST de manières scurisés
     *
     * MoviesRequest représente mon formulaire
     * et la requete en POST de mon formulaire
     *
     * Je rentre dans ma methode store
     * SI ET SEULEMENT SI
     * je n'ai plus aucune erreur dans mon formulaire
     */
    public function store(MoviesRequest $request){

        //crée un objet qui représente mon nouveau film
        $movie = new Movies();
        $movie->type = $request->type;
        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->description = $request->description;


        /* Traitement de l'upload d'image */
        $filename = "";

        // Si j'ai un fichier "image"
        if($request->hasFile('image')) {

            // je récupere mon fichier
            $file = $request->file('image');

            // je récupere le nom du fichier
            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier

            // je stocker le chemin vers lequele mon image va etre envoyé
            $destinationPath = public_path() . '/uploads/movies'; // Indique où stocker le fichier

            // je bouge mon fichier uploadé
            $file->move($destinationPath, $filename); // Déplace le fichier
        }

        //je renseigne le nom de mon image pour mon film
        $movie->image = asset("uploads/movies/". $filename);


        //sauevegarder mon objet Movies en BDD
        $movie->save();




        // je cére un message flash
        Session::flash('success', "Le film {$movie->title} a été enregistré");

        // redirection vers movies_index
        return Redirect::route('movies_index');


//        $movie->trailer = $request->trailer;
//        $movie->categories_id = $request->categories_id;
//        $movie->languages = $request->lang;
//        $movie->distributeur = $request->distributeur;
//        $movie->bo = $request->bo;
//        $movie->annee = $request->annee;
//        $movie->budget = $request->budget;
//        $movie->duree = $request->duree;
//        $movie->date_release = $request->date_release;
//        $movie->note_presse = $request->note_presse;
//        $movie->visible = $request->visible;
//        $movie->cover = $request->cover;
//
//
//        /* Traitement de l'upload d'image */
//        $filename = "";
//        if($request->hasFile('image')) {
//            $file = $request->file('image');
//            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier
//            $destinationPath = public_path() . '/uploads/movies'; // Indique où stocker le fichier
//            $file->move($destinationPath, $filename); // Déplace le fichier
//        }
//        $movie->image = asset("uploads/movies/". $filename);
//
//        $movie->save();
//
//
//        // Traitement des champs de la relations Actors_Movies
//        $actors = $request->actors;
//        if (isset($actors)) {
//            foreach ($actors as $actor) {
//                DB::table('actors_movies')
//                    ->insert([
//                        ['movies_id' => $movie->id, 'actors_id' => $actor]
//                    ]);
//            }
//        }
//
//        // Traitement des champs de la relations Directors_Movies
//        $directors = $request->directors;
//        if (isset($directors)) {
//            foreach ($directors as $director) {
//                DB::table('directors_movies')
//                    ->insert([
//                        ['movies_id' => $movie->id, 'directors_id' => $director]
//                    ]);
//            }
//        }
//
//
//        Session::flash('success', "Le film $movie->title a été enregistré");
//
//        return Redirect::route('movies_index');
    }


}


















