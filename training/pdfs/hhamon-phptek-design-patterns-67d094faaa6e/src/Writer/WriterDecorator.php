<?php

namespace Writer;

abstract class WriterDecorator implements WriterInterface
{
    protected $writer;

    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }
} 
