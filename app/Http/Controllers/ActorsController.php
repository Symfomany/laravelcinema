<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;


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

        // vue
        return view('Actors/index');
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
    public function edit(){

        // vue
        return view('Actors/edit');
    }

    /**
     * Page Acceuil
     */
    public function read(){

        // vue
        return view('Actors/read');
    }

    /**
     * Page Acceuil
     */
    public function delete(){

    }







}


















