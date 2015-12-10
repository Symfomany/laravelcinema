<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * Classe qui va stocker mes requetes autoirs
 * de ma table movies
 * Hérite de ma super classe Model
 */
class Categories extends Model{

    /**
     * Décrit le nom de la table
     * que classe fait référence
     */
    protected $table = 'categories';


    /**
     * Relation avec la classe Movies
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movies()
    {
        return $this->hasMany('App\Http\Models\Movies');
    }






}



