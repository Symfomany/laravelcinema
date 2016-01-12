<?php

namespace Writer;

interface WriterInterface
{
    /**
     * Returns the formatted text.
     *
     * @param  string $text
     * @return string
     */
    public function write($text);
} 
