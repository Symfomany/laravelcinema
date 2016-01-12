<?php

namespace Logger\Tests\Formatter;

use Logger\Formatter\PlainTextFormatter;

class PlainTextFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatMessage()
    {
        $formatter = new PlainTextFormatter();

        $this->assertSame(
            sprintf('[%s] Foo Bar', date('Y-m-d H:i:s')),
            $formatter->format('Foo Bar')
        );
    }
}
