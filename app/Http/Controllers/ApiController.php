<?php

namespace App\Http\Controllers;

use App\Http\Models\Actors;
use App\Http\Models\Categories;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * Me retournera mes données de catégorie.
     */
    public function categories()
    {
        $tab = [];
        $categories = Categories::all();

        foreach ($categories as $categorie) {
            $tab[] =
                [
                    $categorie->title,
                    count($categorie->movies),
                ];
        }

        return $tab;
    }

    /**
     * Get Actors
     * @return array
     */
    public function actors()
    {
        $obj = new Actors();
        $resultat = $obj->getNbActorsByCity();

        //exit(dump($resultat));

        $tab = [];
        foreach ($resultat as $actor) {
            $tab[] = [
                'name' => $actor->city,
                'data' => [(int) $actor->nb],
            ];
        }

        return $tab;
    }
}
