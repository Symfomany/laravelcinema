<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * Classe qui va stocker mes requetes autoirs
 * de ma table movies
 * Hérite de ma super classe Model.
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract

{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Décrit le nom de la table
     * que classe fait référence.
     */
    protected $table = 'user';

    /**
     *  Retourne les 24 derniers utilisateurs.
     */
    public function getLastUsers()
    {

        // retourne le resultat de ma requete SELECT * FROM movies
        $result = DB::table('user')
            ->orderBy('created_at', 'DESC')
            ->take(24)
            ->get(); // traduire en SQL

        return $result;
    }


}
