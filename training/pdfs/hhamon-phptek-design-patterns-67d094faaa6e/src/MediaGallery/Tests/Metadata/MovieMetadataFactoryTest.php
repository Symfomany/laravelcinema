<?php

namespace MediaGallery\Tests\Metadata;

use MediaGallery\Analyzer\VideoAnalyzer;
use MediaGallery\Metadata\MovieMetadataFactory;

class MovieMetadataFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadMetadata()
    {
        $path = __DIR__.'/../Resources/movie.mp4';

        $metadata = $this->createFactory()->loadMetadata($path);

        $this->assertInstanceOf('MediaGallery\Metadata\MovieMetadata', $metadata);
        $this->assertSame(realpath($path), $metadata->getRealPath());
        $this->assertSame(filemtime($path), $metadata->getCreatedAt());
        $this->assertSame(filesize($path), $metadata->getSize());
        $this->assertSame(41, $metadata->getDuration());
        $this->assertSame(1920, $metadata->getXResolution());
        $this->assertSame(1080, $metadata->getYResolution());
        $this->assertSame(90, $metadata->getFrameRate());
        $this->assertSame(1224, $metadata->getFrameCount());
    }

    /** @expectedException \MediaGallery\MediaNotFoundException */
    public function testCannotLoadMovieMetadata()
    {
        $this->createFactory()->loadMetadata('/foo/bar.mp4');
    }

    private function createFactory()
    {
        return new MovieMetadataFactory(new VideoAnalyzer());
    }
}
