<?php

namespace Logger\Tests\Formatter;

use Logger\Formatter\XmlFormatter;

class XmlFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatMessage()
    {
        $formatter = new XmlFormatter();

        $this->assertSame(
            sprintf('<log time="%s">Foo Bar</log>', date('Y-m-d H:i:s')),
            $formatter->format('Foo Bar')
        );
    }
}
