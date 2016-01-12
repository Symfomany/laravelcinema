<?php

namespace Writer;

class UppercaseWriter extends WriterDecorator
{
    public function write($text)
    {
        return strtoupper($this->writer->write($text));
    }
}
