<?php

namespace Templating\Tests;

use League\Plates\Engine;
use Templating\PlatesEngineAdapter;

class PlatesEngineAdapterTest extends \PHPUnit_Framework_TestCase
{
    /** @var PlatesEngineAdapter */
    private $engine;

    /** @dataProvider provideTemplate */
    public function testTemplateExists($template)
    {
        $this->assertTrue($this->engine->exists($template));
    }

    public function provideTemplate()
    {
        return [
            [ 'index.tpl' ],
            [ '//index.tpl' ],
            [ 'blog/blog.tpl' ],
        ];
    }

    public function testTemplateDoesNotExists()
    {
        $this->assertFalse($this->engine->exists('not-found.tpl'));
    }

    public function testTemplateIsSupported()
    {
        $this->assertTrue($this->engine->supports('index.tpl'));
    }

    public function testTemplateIsNotSupported()
    {
        $this->assertFalse($this->engine->supports('index.php'));
    }

    public function testEvaluateTemplate()
    {
        $output = $this->engine->evaluate('index.tpl', [ 'name' => 'Hugo' ]);

        $this->assertSame('<p>Hello Hugo</p>', trim($output));
    }

    /** @expectedException \Templating\Exception\UnsupportedTemplateException */
    public function testCantEvaluateTemplateIfNotSupported()
    {
        $this->engine->evaluate('index.php', [ 'name' => 'Hugo' ]);
    }

    /** @expectedException \Templating\Exception\TemplateNotFoundException */
    public function testCantEvaluateTemplateIfNotFound()
    {
        $this->engine->evaluate('not-found.tpl', [ 'name' => 'Hugo' ]);
    }

    protected function setUp()
    {
        $plates = new Engine(__DIR__.'/Resources/views');
        $plates->setFileExtension(null);
        $plates->addData([ 'foo' => 'bar' ]);

        $this->engine = new PlatesEngineAdapter($plates);
    }

    protected function tearDown()
    {
        $this->engine = null;
    }
}
