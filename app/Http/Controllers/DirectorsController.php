<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;


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
    public function edit(){

        // vue
        return view('Directors/edit');
    }

    /**
     * Page Acceuil
     */
    public function read(){

        // vue
        return view('Directors/read');
    }

    /**
     * Page Acceuil
     */
    public function delete(){

    }



}


















