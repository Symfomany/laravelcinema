<?php

namespace App\Http\Cart\Exception;

/**
 * Class ItemException
 * @package App\Http\Cart\Exception
 */
class ItemException extends \Exception
{


    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}