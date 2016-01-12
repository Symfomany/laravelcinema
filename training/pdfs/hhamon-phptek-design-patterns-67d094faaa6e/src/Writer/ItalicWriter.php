<?php

namespace Writer;

class ItalicWriter extends WriterDecorator
{
    public function write($text)
    {
        return sprintf('<em>%s</em>', $this->writer->write($text));
    }
} 
