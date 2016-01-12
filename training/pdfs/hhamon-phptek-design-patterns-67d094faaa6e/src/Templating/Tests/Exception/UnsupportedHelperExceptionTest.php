<?php

namespace Templating\Tests\Exception;

use Templating\Exception\UnsupportedHelperException;

class UnsupportedHelperExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateException()
    {
        $e = new UnsupportedHelperException('foo', [ 'foo', 'bar' ]);

        $this->assertSame('foo', $e->getInvalidHelper());
        $this->assertSame([ 'foo', 'bar' ], $e->getSupportedHelpers());
    }
}
