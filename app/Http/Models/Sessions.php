<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * Classe qui va stocker mes requetes autoirs
 * de ma table movies
 * Hérite de ma super classe Model
 */
class Sessions extends Model{


    /**
     * Décrit le nom de la table
     * que classe fait référence
     */
    protected $table = 'sessions';


    /**
     * Retourne la moyenne des heure de sessions
     */
    public function getAvgHourDate(){
        $result = DB::table('sessions')
            ->select(DB::raw('ROUND(AVG(HOUR(date_session))) as avghour'))
            ->first();
            // first() retour le premiere résultat
            // get() retourn un tableau de résultat
        return $result;
    }

    /**
     * Recupérer mes 15 prochaines sessions
     * SELECT sessions.date_session AS DATE, movies.title AS mtitle, cinema.title AS ctitle
        FROM sessions
        INNER JOIN movies ON sessions.movies_id = movies.id
        INNER JOIN cinema ON sessions.cinema_id = cinema.id
        WHERE date_session > NOW( )
        LIMIT 0 , 15
     */
    public function getNextSession(){

        /* 1ere methode
        $result = DB::select("SELECT sessions.date_session AS DATE, movies.title AS mtitle, cinema.title AS ctitle
                        FROM sessions
                        INNER JOIN movies ON sessions.movies_id = movies.id
                        INNER JOIN cinema ON sessions.cinema_id = cinema.id
                        WHERE date_session > NOW( )
                        LIMIT 0 , 15");
        */

        $result = DB::table('sessions')

                    ->select("sessions.date_session", "movies.title AS mtitle", "cinema.title AS mcinema")
                    ->join("movies", "sessions.movies_id",'=', "movies.id")
                    ->join("cinema", "sessions.cinema_id",'=', "cinema.id")

                    ->where("date_session",  ">", DB::raw("NOW()"))
                    ->orderBy('date_session', "ASC")
                    ->take(15)
                    ->get();


        return $result;

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movies()
    {
        return $this->belongsTo('App\Http\Models\Movies');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cinema()
    {
        return $this->belongsTo('App\Http\Models\Cinema');
    }



}



