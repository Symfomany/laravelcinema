<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;


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
    public function read(){

        // vue
        return view('Movies/read');
    }
    /**
     * Page Read
     */
    public function edit(){

        // vue
        return view('Movies/edit');
    }
    /**
     * Page delete
     */
    public function delete(){
        //redirection vers ma page d'acceuil
    }




}


















