<?php

namespace App\Http\Cart;

/**
 * Abstract class to store datas in sessions
 * Class AbstractCart.
 */
abstract class AbstractCart
{
    /**
     * @param ItemInterface $item
     */
    abstract public function add(ItemInterface $item);

    /**
     * @param ItemInterface $item
     */
    abstract public function remove(ItemInterface $item);

    /**
     * @return array
     */
    abstract public function clear();

    /**
     * @return array
     */
    abstract public function all();

    /**
     * @return \ArrayIterator
     */
    abstract public function count();

    /**
     * @param array $total
     */
    abstract public function emptycart();
}
