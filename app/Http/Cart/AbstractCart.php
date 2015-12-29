<?php

namespace App\Http\Cart;

/**
 * Class Cart
 * @package App\Http\Cart
 */
abstract class AbstractCart{


    /**
     * @param ItemInterface $item
     */
    abstract  function add(ItemInterface $item);


    /**
     * @param ItemInterface $item
     */
    abstract  function remove(ItemInterface $item);


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

