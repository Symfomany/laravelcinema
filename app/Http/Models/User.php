<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * Classe qui va stocker mes requetes autoirs
 * de ma table movies
 * Hérite de ma super classe Model
 */
class User extends Model{


    /**
     * Décrit le nom de la table
     * que classe fait référence
     */
    protected $table = 'user';

    /**
     *  Retourne les 24 derniers utilisateurs
     */
    public function getLastUsers(){

        // retourne le resultat de ma requete SELECT * FROM movies
        $result =  DB::table('user')
            ->orderBy('created_at', 'DESC')
            ->take(24)
            ->get(); // traduire en SQL

        return $result;
    }


    /**
     *  Retourne tous les films
     */
    public function getAllMovies(){

        // retourne le resultat de ma requete SELECT * FROM movies
        return DB::table('user')->get();
    }









    /**
     * Retourne la catégorie à laquelle appartient un objet film
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo('App\Http\Models\Categories');
    }


    public function comments()
    {
        return $this->hasMany('App\Http\Models\Comments');
    }

    public function actors()
    {
        return $this->belongsToMany('App\Http\Models\Actors');
    }

    public function directors()
    {
        return $this->belongsToMany('App\Http\Models\Directors');
    }

    public function sessions()
    {
        return $this->hasMany('App\Http\Models\Sessions');
    }

    public function recommandations()
    {
        return $this->hasMany('App\Http\Models\Recommandations');
    }






}



