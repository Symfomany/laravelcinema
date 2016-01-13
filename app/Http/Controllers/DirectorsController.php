<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class DirectorsController.
 */
class DirectorsController extends Controller
{
    /**
     * Page Acceuil.
     */
    public function index()
    {
        return view('Directors/index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        // vue
        return view('Directors/create');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        // vue
        return view('Directors/edit');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function read($id)
    {
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
