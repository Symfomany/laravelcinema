<?php

namespace Templating\Tests;

use Templating\TwigEngineAdapter;

class TwigEngineAdapterTest extends \PHPUnit_Framework_TestCase
{
    /** @var TwigEngineAdapter */
    private $engine;

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

    /** @expectedException \Templating\Exception\UnsupportedTemplateException */
    public function testCannotLoadTemplate()
    {
        $this->engine->loadTemplate('invalid.twig');
    }

    public function testTemplateDoesNotExists()
    {
        $this->assertFalse($this->engine->exists('not-found.twig'));
    }

    public function testTemplateIsSupported()
    {
        $this->assertTrue($this->engine->supports('index.twig'));
    }

    public function testTemplateIsNotSupported()
    {
        $this->assertFalse($this->engine->supports('index.php'));
    }

    public function testEvaluateTemplate()
    {
        $output = $this->engine->evaluate('index.twig', [ 'name' => 'Hugo' ]);

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
        $this->engine->evaluate('not-found.twig', [ 'name' => 'Hugo' ]);
    }

    protected function setUp()
    {
        $this->engine = new TwigEngineAdapter(new \Twig_Environment(new \Twig_Loader_Filesystem(__DIR__.'/Resources/views')));
    }

    protected function tearDown()
    {
        $this->engine = null;
    }
}
