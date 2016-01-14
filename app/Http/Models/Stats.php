<?php
namespace App\Http\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class Stats extends Eloquent {

    protected $collection = 'stats';
    protected $connection = 'mongodb';

}
