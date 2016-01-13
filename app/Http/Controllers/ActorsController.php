<?php

namespace App\Http\Controllers;

use App\Http\Models\Actors;
use Illuminate\Http\Request;

/**
 * Class ActorsController
 * @package App\Http\Controllers
 */
class ActorsController extends Controller
{
    /**
     * Page Acceuil.
     */
    public function index()
    {
        $actors = Actors::all();
        // vue
        return view('Actors/index', [

            'actors' => $actors,
        ]);
    }

    /**
     * Page Read
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function read($id)
    {

        // vue
        return view('Actors/read');
    }

    /**
     * Page Acceuil.
     */
    public function create()
    {
        return view('Actors/create');
    }

    /**
     * Page Acceuil.
     */
    public function edit($id)
    {
        return view('Actors/edit');
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
