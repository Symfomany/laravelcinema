<?php

namespace Templating\Tests;

use Templating\Helper\DateHelper;
use Templating\Helper\TextHelper;
use Templating\PhpEngine;

class PhpEngineTest extends \PHPUnit_Framework_TestCase
{
    /** @var PhpEngine */
    private $engine;

    /** @dataProvider provideValueToEscape */
    public function testEscapeContent($value, $escaped)
    {
        $this->assertSame($escaped, $this->engine->escape($value));
    }

    public function provideValueToEscape()
    {
        $date = new \DateTime('2014-11-29');

        return [
            [ 'foo', 'foo' ],
            [ '<strong>foo</strong>', '&lt;strong&gt;foo&lt;/strong&gt;'],
            [ '<strong class="qux">foo</strong>', '&lt;strong class=&quot;qux&quot;&gt;foo&lt;/strong&gt;' ],
            [ 10, 10 ],
            [ 35.10, 35.10 ],
            [ true, true ],
            [ false, false ],
            [ null, null ],
            [ $date, $date ],
        ];
    }

    /** @expectedException \BadMethodCallException */
    public function testRegisterHelperWithArrayAccessSyntaxIsNotAllowed()
    {
        $this->engine['session'] = $this->getMock('Templating\Helper\HelperInterface');
    }

    /** @expectedException \BadMethodCallException */
    public function testUnsetHelperIsNotAllowed()
    {
        unset($this->engine['escape']);
    }

    /** @expectedException \Templating\Exception\UnsupportedHelperException */
    public function testThrowUnsupportedHelperException()
    {
        $this->engine['session'];
    }

    public function testArrayAccessInterface()
    {
        $this->assertTrue(isset($this->engine['text']));
        $this->assertTrue(isset($this->engine['escape']));
        $this->assertTrue(isset($this->engine['date']));
        $this->assertFalse(isset($this->engine['session']));
        
        $this->assertSame('text', $this->engine['text']->getName());
        $this->assertSame('escape', $this->engine['escape']->getName());
        $this->assertSame('date', $this->engine['date']->getName());
    }

    /** @dataProvider provideTemplate */
    public function testTemplateExists($template)
    {
        $this->assertTrue($this->engine->exists($template));
    }

    public function provideTemplate()
    {
        return [
            [ 'index.php' ],
            [ '//index.php' ],
            [ 'blog/blog.php' ],
        ];
    }

    public function testTemplateDoesNotExists()
    {
        $this->assertFalse($this->engine->exists('not-found.php'));
    }

    public function testTemplateIsSupported()
    {
        $this->assertTrue($this->engine->supports('index.php'));
    }

    public function testTemplateIsNotSupported()
    {
        $this->assertFalse($this->engine->supports('index.twig'));
    }

    public function testEvaluateTemplate()
    {
        $output = $this->engine->evaluate('index.php', [ 'name' => 'Hugo' ]);

        $this->assertSame('<p>Hello Hugo</p>', trim($output));
    }

    /** @expectedException \Templating\Exception\ReservedKeywordException */
    public function testRejectViewVariableName()
    {
        $this->engine->evaluate('index.php', [ 'view' => 'foo' ]);
    }

    /** @expectedException \Templating\Exception\UnsupportedTemplateException */
    public function testCantLoadTemplateIfNotSupported()
    {
        $this->engine->evaluate('index.twig', [ 'name' => 'Hugo' ]);
    }

    /** @expectedException \Templating\Exception\TemplateNotFoundException */
    public function testCantLoadTemplateIfNotFound()
    {
        $this->engine->evaluate('not-found.php', [ 'name' => 'Hugo' ]);
    }

    protected function setUp()
    {
        $this->engine = new PhpEngine(__DIR__.'/Resources/views');
        $this->engine->addHelper(new TextHelper());
        $this->engine->addHelper(new DateHelper());
    }

    protected function tearDown()
    {
        $this->engine = null;
    }
}
