<?php

namespace App\Http\Models;

use Jenssegers\Mongodb\Model as Eloquent;


/**
 * Class Tweets.
 */
class Tweets extends Eloquent
{
    protected $collection = 'tweets';
    protected $connection = 'mongodb';

}
