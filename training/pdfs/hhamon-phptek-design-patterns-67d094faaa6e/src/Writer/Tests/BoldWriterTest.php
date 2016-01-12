<?php

namespace Writer\Tests;

use Writer\BoldWriter;
use Writer\Pen;

class BoldWriterTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteInBold()
    {
        $pen = new BoldWriter(new Pen());

        $this->assertSame('<strong>foo bar</strong>', $pen->write('foo bar'));
    }
}
