<?php

namespace App\Http\Cart;

/**
 * To Interfacing with concretes classes
 * Interface ItemInterface
 * @package App\Http\Cart
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
