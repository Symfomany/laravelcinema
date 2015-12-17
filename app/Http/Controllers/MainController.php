<?php

namespace App\Http\Controllers;
use App\Http\Models\Actors;
use App\Http\Models\Comments;
use App\Http\Models\Movies;
use App\Http\Models\Sessions;
use App\Http\Models\User;
use Illuminate\Support\Facades\DB;


/**
 * Class MainController
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


















