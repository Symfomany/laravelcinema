<?php

namespace App\Http\Controllers;


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

        return view('Main/dashboard');
    }

}


















