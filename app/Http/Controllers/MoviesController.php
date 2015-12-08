<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;



use Illuminate\Http\Request;


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

        // vue
        return view('Movies/index');
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
     * Page delete
     */
    public function delete($id){
        //redirection vers ma page d'acceuil
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
        $input = $request->only(['title', 'desc']);

        //exit() => sortir de l'execution PHP
        // dump() fonction de debogage

    }


}


















