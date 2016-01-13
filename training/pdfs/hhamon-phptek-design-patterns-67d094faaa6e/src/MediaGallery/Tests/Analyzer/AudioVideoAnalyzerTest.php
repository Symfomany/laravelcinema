<?php

namespace MediaGallery\Tests\Analyzer;

use MediaGallery\Analyzer\AudioVideoAnalyzer;

class AudioVideoAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    /** @expectedException \MediaGallery\Analyzer\AnalysisFailedException */
    public function testCannotAnalyzeFile()
    {
        $analyzer = new DummyAudioVideoAnalyzer();
        $analyzer->analyze(new \SplFileInfo('/foo/bar'));
    }
}

class DummyAudioVideoAnalyzer extends AudioVideoAnalyzer
{
    protected function createAnalysisReport(\SplFileInfo $file, array $metadata)
    {
        return [];
    }
}
