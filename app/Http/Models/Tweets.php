<?php

namespace App\Http\Models;

use Mongo\Mongodb\Model as Eloquent;

/**
 * Class Tweets.
 */
class Tweets extends Eloquent
{
    protected $collection = 'tweets';
    protected $connection = 'mongodb';
}
