<?php

namespace Templating\Tests;

use Templating\Template;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTemplate()
    {
        $path = realpath(__DIR__.'/Resources/views/index.php');
        $vars = ['name' => 'Hugo'];

        $template = new Template($path, $vars);
        $template->set('foo', 'bar');

        $this->assertSame($path, $template->getPath());
        $this->assertEquals(['name' => 'Hugo', 'foo' => 'bar'], $template->getVariables());
        $this->assertTrue($template->has('name'));
        $this->assertTrue($template->has('foo'));
        $this->assertFalse($template->has('view'));
    }
}
