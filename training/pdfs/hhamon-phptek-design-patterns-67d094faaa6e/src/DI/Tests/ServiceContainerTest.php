<?php

namespace DI\Tests;

use DI\ServiceContainer;

class ServiceContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testLoggerServiceIsShared()
    {
        $dic = new ServiceContainer();
        $logger1 = $dic->get('logger');
        $logger2 = $dic->get('logger');

        $this->assertInstanceOf('DI\Logger', $logger1);
        $this->assertSame($logger1, $logger2);
    }

    /** @expectedException \DI\ServiceNotFoundException */
    public function testGetUnknownService()
    {
        $dic = new ServiceContainer();
        $dic->get('foobar');
    }
}
