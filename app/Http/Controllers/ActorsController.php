<?php
namespace App\Http\Controllers;
use App\Http\Models\Actors;
use Illuminate\Http\Request;


/**
 * Class ActorsController
 * @package App\Http\Controllers
 * Sufficé par le mot clef Controller
 * et doit hérité de la super classe Controller
 */
class ActorsController extends Controller{


    /**
     * Page Acceuil
     */
    public function index(){

        $actors = Actors::all();
        // vue
        return view('Actors/index', [

            'actors' => $actors
        ]);
    }

    /**
     * Page Acceuil
     */
    public function read($id){

        // vue
        return view('Actors/read');
    }

    /**
     * Page Acceuil
     */
    public function create(){

        // vue
        return view('Actors/create');
    }

    /**
     * Page Acceuil
     */
    public function edit($id){

        // vue
        return view('Actors/edit');
    }

    /**
     * Page Acceuil
     */
    public function delete($id){

    }


    /**
     * Action d'enregistrement en base de données
     * depuis mon formulaire
     * Classe Request permet de réceptionner les données
     * en POST de manières scurisés
     */
    public function store(Request $request){

        //recupérer le titre de mon film en POST
        //input(name de mon champ) permet de récupérer
        // la données titre en POST de manière sécurisée
        $firstname = $request->input(['firstname']);
        $lastname = $request->input(['lastname']);

        //exit() => sortir de l'execution PHP
        // dump() fonction de debogage


    }





}


















