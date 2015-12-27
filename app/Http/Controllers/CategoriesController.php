<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;

use App\Http\Models\Categories;
use Illuminate\Http\Request;


/**
 * Class MainController
 * @package App\Http\Controllers
 * Sufficé par le mot clef Controller
 * et doit hérité de la super classe Controller
 */
class CategoriesController extends Controller{

    /**
     * Page de liste des catégories
     */
    public function index(){

        // récupérer toutes mes catégories
        $categories = Categories::all();

        return view('Categories/index', [
            'categories' => $categories
        ]);
    }


    /**
     * Page Acceuil
     */
    public function create(){

        // vue
        return view('Categories/create');
    }


    /**
     * Page Acceuil
     */
    public function edit(){

        // vue
        return view('Categories/edit');
    }

    /**
     * Page Acceuil
     */
    public function read($id){

        // vue
        return view('Categories/read');
    }

    /**
     * Page Acceuil
     */
    public function delete(){

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
        $input = $request->input(['title']);

        //exit() => sortir de l'execution PHP
        // dump() fonction de debogage


    }




}


















