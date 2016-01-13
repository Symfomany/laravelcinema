<?php

namespace Writer\Tests;

use Writer\Pen;
use Writer\UppercaseWriter;

class UppercaseWriterTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteInUppercase()
    {
        $pen = new UppercaseWriter(new Pen());

        $this->assertSame('FOO BAR', $pen->write('foo bar'));
    }
}
