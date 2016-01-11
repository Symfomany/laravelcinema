<?php

namespace App\Http\Controllers;

use App\Http\Models\Categories;
use Illuminate\Http\Request;

/**
 * Class MainController.
 */
class CategoriesController extends Controller
{
    /**
     * Page de liste des catégories.
     */
    public function index()
    {

        // récupérer toutes mes catégories
        $categories = Categories::all();

        return view('Categories/index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Page Acceuil.
     */
    public function create()
    {

        // vue
        return view('Categories/create');
    }

    /**
     * Page Acceuil.
     */
    public function edit()
    {

        // vue
        return view('Categories/edit');
    }

    /**
     * Page Acceuil.
     */
    public function read($id)
    {

        // vue
        return view('Categories/read');
    }

    /**
     * Page Acceuil.
     */
    public function delete()
    {
    }

    /**
     * Action d'enregistrement en base de données
     * depuis mon formulaire
     * Classe Request permet de réceptionner les données
     * en POST de manières scurisés.
     */
    public function store(Request $request)
    {
    }
}
