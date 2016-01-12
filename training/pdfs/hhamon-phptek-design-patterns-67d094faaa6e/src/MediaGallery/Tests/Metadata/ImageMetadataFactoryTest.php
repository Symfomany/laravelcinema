<?php

namespace MediaGallery\Tests\Metadata;

use MediaGallery\Analyzer\ImageAnalyzer;
use MediaGallery\Metadata\ImageMetadata;
use MediaGallery\Metadata\ImageMetadataFactory;

class ImageMetadataFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadMetadata()
    {
        $path = __DIR__.'/../Resources/landscape.png';

        $metadata = $this->createFactory()->loadMetadata($path);

        $this->assertInstanceOf('MediaGallery\Metadata\ImageMetadata', $metadata);
        $this->assertSame(realpath($path), $metadata->getRealPath());
        $this->assertSame(filemtime($path), $metadata->getCreatedAt());
        $this->assertSame(filesize($path), $metadata->getSize());
        $this->assertSame(ImageMetadata::LANDSCAPE, $metadata->getOrientation());
        $this->assertSame(556, $metadata->getWidth());
        $this->assertSame(385, $metadata->getHeight());
    }

    /** @expectedException \MediaGallery\MediaNotFoundException */
    public function testCannotLoadImageMetadata()
    {
        $this->createFactory()->loadMetadata('/foo/bar.png');
    }

    private function createFactory()
    {
        return new ImageMetadataFactory(new ImageAnalyzer());
    }
}
