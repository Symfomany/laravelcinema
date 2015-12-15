<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * Classe qui va stocker mes requetes autoirs
 * de ma table movies
 * Hérite de ma super classe Model
 */
class Comments extends Model{

    /**
     * Décrit le nom de la table
     * que classe fait référence
     */
    protected $table = 'comments';



    public function bestCommenter()
    {


        $bestCommenter = DB::select('
            SELECT user.username, COUNT( user_id ) AS nb_comments
            FROM  `comments`
            LEFT JOIN user ON user.id = comments.user_id
            GROUP BY user_id
            ORDER BY COUNT( user_id ) DESC
            LIMIT 1');

        return $bestCommenter;
    }

    /* RELATIONS */

    public function movie()
    {
        return $this->belongsTo('\App\Http\Models\Movies', 'movies_id');
    }

    public function user()
    {
        return $this->belongsTo('\App\Http\Models\Users');
    }


}



