<?php

namespace App\Http\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class Videos extends Eloquent {

    protected $collection = 'videos';
    protected $connection = 'mongodb';

}
