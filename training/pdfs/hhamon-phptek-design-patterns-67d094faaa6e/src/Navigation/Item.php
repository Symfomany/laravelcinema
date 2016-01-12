<?php

namespace Navigation;

class Item implements ItemInterface
{
    private $label;
    private $link;
    private $items;

    public function __construct($label, $link = null, array $items = [])
    {
        $this->label = $label;
        $this->link = $link;
        $this->items = [];
        $this->addChildren($items);
    }

    private function addChildren(array $children)
    {
        foreach ($children as $child) {
            $this->add($child);
        }
    }

    public function add(ItemInterface $item)
    {
        if (!in_array($item, $this->items)) {
            $this->items[] = $item;
        }
    }

    /**
     * Returns the item's label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Returns the item's link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Returns the nested items.
     *
     * @return ItemInterface[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Returns whether or not there are nested items.
     *
     * @return bool
     */
    public function hasItems()
    {
        return count($this->items) > 0;
    }
}
