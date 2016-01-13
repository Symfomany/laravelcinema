<?php

namespace Navigation;

interface ItemInterface
{
    /**
     * Returns the item's label.
     *
     * @return string
     */
    public function getLabel();

    /**
     * Returns the item's link.
     *
     * @return string
     */
    public function getLink();

    /**
     * Returns the nested items.
     *
     * @return ItemInterface[]
     */
    public function getItems();

    /**
     * Returns whether or not there are nested items.
     *
     * @return bool
     */
    public function hasItems();
}
