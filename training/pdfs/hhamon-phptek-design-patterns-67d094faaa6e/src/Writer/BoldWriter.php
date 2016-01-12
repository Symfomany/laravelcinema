<?php

namespace Writer;

class BoldWriter extends WriterDecorator
{
    public function write($text)
    {
        return sprintf('<strong>%s</strong>', $this->writer->write($text));
    }
} 
