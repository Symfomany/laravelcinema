<?php

namespace Logger\Tests;

use Logger\Formatter\PlainTextFormatter;
use Logger\Formatter\XmlFormatter;
use Logger\Logger;

class LoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testLogMessageWithDefaultFormatter()
    {
        $logger = new Logger(new PlainTextFormatter());
        $logger->log('Foo Bar');
        $logger->log('Bar Foo');

        $logs = $logger->getLogs();
        
        $this->assertCount(2, $logs);
        $this->assertRegExp('#^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\] \w+#i', $logs[0]);
        $this->assertRegExp('#^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\] \w+#i', $logs[1]);
    }

    public function testLogMessageWithCustomFormatter()
    {
        $logger = new Logger(new PlainTextFormatter());
        $logger->log('Foo Bar', new XmlFormatter());
        $logger->log('Bar Foo', new XmlFormatter());

        $logs = $logger->getLogs();

        $this->assertCount(2, $logs);
        $this->assertRegExp('#<log time="\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}">Foo Bar<\/log>#', $logs[0]);
        $this->assertRegExp('#<log time="\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}">Bar Foo<\/log>#', $logs[1]);
    }
}
