<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class MainController.
 */
class DirectorsController extends Controller
{
    /**
     * Page Acceuil.
     */
    public function index()
    {

        // vue
        return view('Directors/index');
    }

    /**
     * Page Acceuil.
     */
    public function create()
    {

        // vue
        return view('Directors/create');
    }

    /**
     * Page Acceuil.
     */
    public function edit($id)
    {

        // vue
        return view('Directors/edit');
    }

    /**
     * Page Acceuil.
     */
    public function read($id)
    {

        // vue
        return view('Directors/read');
    }

    /**
     * Page Acceuil.
     */
    public function delete($id)
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
