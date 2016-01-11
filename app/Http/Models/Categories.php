<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe qui va stocker mes requetes autoirs
 * de ma table movies
 * Hérite de ma super classe Model.
 */
class Categories extends Model
{
    /**
     * Décrit le nom de la table
     * que classe fait référence.
     */
    protected $table = 'categories';

    /**
     * Relation avec la classe Movies
     * One To Many 1..n
     * le nom de la méthode movies() doot porter le nom de
     * ma table mis en relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movies()
    {
        // namespace + nom de la classe mis en relation
        return $this->hasMany('App\Http\Models\Movies');
    }
}
