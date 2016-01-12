<?php

namespace MediaGallery\Tests\Analyzer;

use MediaGallery\Analyzer\ImageAnalyzer;

class ImageAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    /** @expectedException \MediaGallery\Analyzer\AnalysisFailedException */
    public function testCannotAnalyzeImage()
    {
        $analyzer = new ImageAnalyzer();
        $analyzer->analyze(new \SplFileInfo(__FILE__));
    }
}
