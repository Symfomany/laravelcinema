<?php

namespace Writer;

class Pen implements WriterInterface
{
    /**
     * Returns the formatted text.
     *
     * @param  string $text
     * @return string
     */
    public function write($text)
    {
        return $text;
    }
}
