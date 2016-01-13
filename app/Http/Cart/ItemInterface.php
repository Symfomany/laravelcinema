<?php

namespace App\Http\Cart;

/**
 * To Interfacing with concretes classes
 * Interface ItemInterface.
 */
interface ItemInterface
{
    /**
     * @return mixed
     */
    public function add(ItemInterface $item);

    /**
     * @return mixed
     */
    public function remove(ItemInterface $item);
}
