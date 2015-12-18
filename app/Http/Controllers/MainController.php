<?php

namespace App\Http\Controllers;
use App\Http\Models\Actors;
use App\Http\Models\Comments;
use App\Http\Models\Movies;
use App\Http\Models\Sessions;
use App\Http\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


/**
 * Class MainController
 * V2 Fin de promotion
 * texte pour exemple
 * @package App\Http\Controllers
 * Sufficé par le mot clef Controller
 * et doit hérité de la super classe Controller
 */
class MainController extends Controller{

    /**
     * Page Acceuil
     */
    public function index(){

        return view('Main/index');
    }


    public function ajaxmovies(Request $request){

        $title = $request->title;

        $validator = Validator::make(
            $request->all(),  //request all : tous les elements de requetses
            [
            'title' => 'required|min:10',
            ],[
            'title.required' => "Votre titre est obligatoire",
            'title.min' => "Votre titre est trop court"
            ]);

        if ($validator->fails()) { // si mon validateur échoue
            return $validator->errors()->all();
        }else{
            Movies::create([
                'title' => $request->title,
                'description' => $request->description,
                'categories_id' => $request->categories_id
            ]);

            return $request->title;
        }




    }


    /**
     * Page Acceuil
     */
    public function dashboard(){


        $nbacteurs = Actors::count();
        $nbcommentaires = Comments::count();
        $nbmovies = Movies::count();
        $nbseances = Sessions::count();

        $actor = new Actors(); // Je récpere mon modèle
        $comment = new Comments(); // Je récpere mon modèle
        $movie = new Movies(); // Je récpere mon modèle
        $session = new Sessions(); // Je récpere mon modèle
        $user = new User(); // Je récpere mon modèle

        $avgacteurs = $actor->getAvgActors();
        $avgnotecommentaire = $comment->getAvgNote();
        $avgnotepresse = $movie->getAvgNotePresse();
        $avghour = $session->getAvgHourDate();

        $seances = $session->getNextSession();
        $users = $user->getLastUsers();

        //exit(dump($users));

        /*
         $seances = Sessions::where("date_session",  ">", DB::raw("NOW()"))
        ->take(15)->get();
        */

        return view('Main/dashboard',[
            'avgnotecommentaire' => $avgnotecommentaire->avgnote,
            'avgnotepresse' => $avgnotepresse->avgpress,
            'avgacteurs' => $avgacteurs->age,
            'avghour' => $avghour->avghour,
            'nbacteurs' => $nbacteurs,
            'nbcommentaires' => $nbcommentaires,
            'nbmovies' => $nbmovies,
            'nbseances' => $nbseances,
            'seances' => $seances,
            'users' => $users,
        ]);
    }

}


















