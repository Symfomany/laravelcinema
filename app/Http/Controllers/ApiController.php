<?php

namespace App\Http\Controllers;
use App\Http\Models\Actors;
use App\Http\Models\Categories;
use App\Http\Models\Comments;
use App\Http\Models\Movies;
use App\Http\Models\Sessions;
use App\Http\Models\User;
use Illuminate\Support\Facades\DB;


/**
 * Class ApiController
 * @package App\Http\Controllers
 * Sufficé par le mot clef Controller
 * et doit hérité de la super classe Controller
 */
class ApiController extends Controller{


    /**
     * Me retournera mes données de catégorie
     */
    public function categories(){

        $tab = [];
        $categories = Categories::all();

        foreach($categories as $categorie){
            $tab[] =
                [
                    $categorie->title,
                    count($categorie->movies)
                ];
        }

        return $tab;

    }


}


















