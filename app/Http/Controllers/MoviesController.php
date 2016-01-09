<?php
namespace App\Http\Controllers;

use App\Http\Models\Actors;
use App\Http\Models\Categories;
use App\Http\Models\Directors;
use App\Http\Models\Movies;
use App\Http\Requests\MoviesRequest;
use Illuminate\Http\Request;
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
        $movies = Movies::all();

        return view('Movies/index',[
                'movies' => $movies,
            ]
        );
    }

    /**
     * Page Create
     */
    public function create(){

        $categories = Categories::all();
        $actors = Actors::all();
        $directors = Directors::all();


        return view('Movies/create',
        [
            'categories' => $categories,
            'actors' => $actors,
            'directors' => $directors,
        ]);

    }


    /**
     * Page Read
     */
    public function read($id){

        return view('Movies/read');
    }
    /**
     * Page Read
     */
    public function edit($id){

        $categories = Categories::all();
        $actors = Actors::all();
        $directors = Directors::all();

        $movie = Movies::find($id);
        return view('Movies/edit', [
            'movie' => $movie,
            'categories' => $categories,
            'actors' => $actors,
            'directors' => $directors,
        ]);
    }


    /**
     * Action qui va me permettre d'activer un film
     * @param $id
     */
    public function activate($id){
        $movie = Movies::find($id);

        if($movie->visible == 0){
            $movie->visible = 1;
            Session::flash("success","Le film {$movie->title} a bien été activé");

        }
        else{
            $movie->visible = 0;
            Session::flash("success","Le film {$movie->title} a bien été desactivé");
        }

        $movie->save();

        return Redirect::route('movies_index');
    }


    /**
     * Action qui va me permettre de metter en avant un film
     * @param $id
     */
    public function cover($id){
        $movie = Movies::find($id);

        if($movie->cover == 0){
            $movie->cover = 1;
            Session::flash("success","Le film {$movie->title} a bien été mis en avant");

        }
        else{
            $movie->cover = 0;
            Session::flash("danger","Le film {$movie->title} a bien été retiré de l'avant");
        }

        $movie->save();

        return Redirect::route('movies_index');
    }



    /**
     * Suppresion
     */
    public function delete($id){

        $movie = Movies::find($id);

        if($movie){
            Session::flash('success', "Le film {$movie->title} a bien été supprimé");
            $movie->delete();
        }

        return Redirect::route('movies_index');
    }


    /**
     * Fonction de like des films, enregistré en session
     * Session : mécanisme de stockage temporelle
     * BDD: mécanisme de stockage atemporelle
     * @param Request $request
     */
    public function like($id, $action)
    {
        $movie = Movies::find($id);

        $likes = session("likes", []);

        // si l'action est "like"
        if ($action == "like") {

            // J'ajoute mon movie dans le tableaux des likes en session
            $likes[$id] = $movie->id;
            Session::flash('danger', "Le film {$movie->title} a bien été liké");

        }else{

            // je supprime le like dans le tableaux des likes
            // unset() supprimer un element dans un tableau en PHP
            unset($likes[$id]);

            Session::flash('success', "Le film {$movie->title} a bien été disliké");
        }


        //j'enregistre en session mon nouveau tableaux des likes
        Session::put("likes", $likes);

        // une redirection avec message flash
        return Redirect::route('movies_index');

    }



    /**
     * Store database
     */
    public function store(MoviesRequest $request){

        $dateoutput =  \DateTime::createFromFormat('d/m/Y',$request->date_release);
        $movie = new Movies();
        $movie->type = $request->type;
        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->description = $request->description;
        $movie->trailer = $request->trailer;
        $movie->date_release = $dateoutput;
        $movie->visible = $request->visible;
        $movie->cover = $request->cover;
        $movie->languages = $request->lang;
        $movie->categories_id = $request->categories_id;
        $movie->note_presse = $request->note_presse;
        $movie->distributeur = $request->distributeur;

        $filename = "";

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier
            $destinationPath = public_path() . '/uploads/movies'; // Indique où stocker le fichier
            $file->move($destinationPath, $filename); // Déplace le fichier
        }

        $movie->image = asset("uploads/movies/". $filename);
        $movie->save();

        $actors = $request->actors;
        if (isset($actors)) {
            foreach ($actors as $actor) {
                DB::table('actors_movies')
                    ->insert([
                        ['movies_id' => $movie->id, 'actors_id' => $actor]
                    ]);
            }
        }

        $directors = $request->directors;
        if (isset($directors)) {
            foreach ($directors as $director) {
                DB::table('directors_movies')
                    ->insert([
                        ['movies_id' => $movie->id, 'directors_id' => $director]
                    ]);
            }
        }


        Session::flash('success', "Le film {$movie->title} a été enregistré");
        return Redirect::route('movies_index');

    }


}


















