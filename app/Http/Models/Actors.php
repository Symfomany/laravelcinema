<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Classe qui va stocker mes requetes autoirs
 * de ma table movies
 * Hérite de ma super classe Model.
 */
class Actors extends Model
{
    /**
     * Décrit le nom de la table
     * que classe fait référence.
     */
    protected $table = 'actors';

    public function movies()
    {
        return $this->belongsToMany('\App\Http\Model\Movies');
    }

    /**
     * Get nb actors by city.
     * @return mixed
     */
    public function getNbActorsByCity()
    {
        $result = DB::table('actors')
                    ->select(DB::raw('COUNT(id) as nb'), 'city')
                    ->groupBy('city')
                    ->get();

        return $result;
    }

    /**
     * Retourne la moyenne d'age des acteurs
     * 1er mode de Laravel pour construire mes requetes
     * Cela me permet de conserver une syntaxe pure en Mysql.
     */
    public function getAvgActors()
    {

        //1ere methode: Utilisation de MYSQL
        // marche mais n'est peu souple
         /*
          * $results = DB::select('
            SELECT ROUND(AVG(TIMESTAMPDIFF(YEAR,dob, NOW()))) as age
            FROM actors
        ');
         */

        // 2nd méthode: PHP & MYSQL
        // Query Builder: Le constructeur de Requête en Laravel
        // DB::table => correspond FROM actors en MYSQL
        // select() => corresponds a mon SELECT en MYSQL
        // DB::raw() => permet d'utiliser les fonctions MYSQL
        // comme ROUND() AVG() NOW()...

        // first() => corresponds LIMIT 1 en MYSQL

        // first() => l'equivalent de fetch()
        // get() => l'équivalent de fetchAll()

        // MAITRISE

          $results = DB::table('actors')
            ->select(DB::raw('ROUND(AVG(TIMESTAMPDIFF(YEAR,dob, NOW()))) as age'))
            ->first();

        /*
          $results = Actors::select(DB::raw('ROUND(AVG(TIMESTAMPDIFF(YEAR,dob, NOW()))) as age'))
            ->first();
        */

        //3eme methode: Eloquant ORM
        // Model Actors
        // <=> SELECT AVG(dob) FROM actors
        //$results = Actors::avg('dob');

        // je retourne le resultat de ma requete executé
        return $results;
    }
}
