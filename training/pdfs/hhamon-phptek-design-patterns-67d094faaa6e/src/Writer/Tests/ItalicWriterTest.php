<?php

namespace Writer\Tests;

use Writer\ItalicWriter;
use Writer\Pen;

class ItalicWriterTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteInItalic()
    {
        $pen = new ItalicWriter(new Pen());

        $this->assertSame('<em>foo bar</em>', $pen->write('foo bar'));
    }
}
