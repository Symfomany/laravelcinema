<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


/**
 * Class MainController
 * @package App\Http\Controllers
 * Sufficé par le mot clef Controller
 * et doit hérité de la super classe Controller
 */
class DirectorsController extends Controller{

    /**
     * Page Acceuil
     */
    public function index(){

        // vue
        return view('Directors/index');
    }



    /**
     * Page Acceuil
     */
    public function create(){

        // vue
        return view('Directors/create');
    }

    /**
     * Page Acceuil
     */
    public function edit($id){

        // vue
        return view('Directors/edit');
    }

    /**
     * Page Acceuil
     */
    public function read($id){

        // vue
        return view('Directors/read');
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


















