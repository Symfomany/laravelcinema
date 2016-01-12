<?php

namespace Templating\Tests\Helper;

use Templating\Helper\TextHelper;

class TextHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var TextHelper */
    private $helper;

    /** @dataProvider provideTextToFormatToParagraphs */
    public function testFormatParagraphs($text, $formatted)
    {
        $this->assertSame($formatted, $this->helper->paragraphs($text));
    }

    public function provideTextToFormatToParagraphs()
    {
        return [
            [ 'A simple text', '<p>A simple text</p>' ],
            [ "One\n\nTwo\n\n\nThree\n", '<p>One</p><p>Two</p><p>Three</p>' ],
            [ "One\n\nTwo\n\n\nThree\nFour", "<p>One</p><p>Two</p><p>Three<br />Four</p>" ],
            
        ];
    }
    protected function setUp()
    {
        $this->helper = new TextHelper();
    }

    protected function tearDown()
    {
        $this->helper = null;
    }
}
