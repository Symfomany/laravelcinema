<?php

namespace Templating\Tests;

use League\Plates\Engine as PlatesEngine;
use Templating\ChainEngine;
use Templating\PhpEngine;
use Templating\PlatesEngineAdapter;
use Templating\TwigEngineAdapter;

class ChainEngineTest extends \PHPUnit_Framework_TestCase
{
    /** @var ChainEngine */
    private $engine;

    /** @dataProvider provideNotFoundTemplate */
    public function testTemplateDoesNotExists($template)
    {
        $this->assertFalse($this->engine->exists($template));
    }

    public function provideNotFoundTemplate()
    {
        return [
            [ 'foobar.php' ],
            [ 'foobar.tpl' ],
            [ 'foobar.twig' ],
        ];
    }

    public function testTemplateIsNotSupported()
    {
        $this->assertFalse($this->engine->supports('foo.bar'));
    }

    /** @dataProvider provideSupportedTemplate */
    public function testTemplateExists($template)
    {
        $this->assertTrue($this->engine->exists($template));
    }

    /** @dataProvider provideSupportedTemplate */
    public function testTemplateIsSupported($template)
    {
        $this->assertTrue($this->engine->supports($template));
    }

    /** @dataProvider provideSupportedTemplate */
    public function testEvaluateTemplate($template)
    {
        $output = $this->engine->evaluate($template, [ 'name' => 'Hugo' ]);

        $this->assertSame('<p>Hello Hugo</p>', trim($output));
    }

    /** @dataProvider provideSupportedTemplate */
    public function testLoadTemplate($template)
    {
        $this->assertInstanceOf(
            'Templating\Template',
            $this->engine->loadTemplate($template, [ 'name' => 'Hugo' ])
        );
    }

    public function provideSupportedTemplate()
    {
        return [
            [ 'index.php' ],
            [ 'index.tpl' ],
            [ 'index.twig' ],
        ];
    }

    /** @expectedException \Templating\Exception\UnsupportedTemplateException */
    public function testUnableToEvaluateUnsupportedTemplate()
    {
        $this->engine->evaluate('foo.txt');
    }

    /** @expectedException \Templating\Exception\UnsupportedTemplateException */
    public function testUnableToLoadUnsupportedTemplate()
    {
        $this->engine->loadTemplate('foo.txt');
    }

    protected function setUp()
    {
        $this->engine = new ChainEngine([
            new PlatesEngineAdapter(new PlatesEngine(__DIR__.'/Resources/views', null)),
            new TwigEngineAdapter(new \Twig_Environment(new \Twig_Loader_Filesystem(__DIR__.'/Resources/views'))),
            new PhpEngine(__DIR__.'/Resources/views'),
        ]);
    }

    protected function tearDown()
    {
        $this->engine = null;
    }
}
