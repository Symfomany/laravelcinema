<?php

namespace MediaGallery\Tests\Metadata;

use MediaGallery\Analyzer\AudioAnalyzer;
use MediaGallery\Metadata\SoundMetadataFactory;

class SoundMetadataFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadMetadata()
    {
        $path = __DIR__.'/../Resources/sound.mp3';

        $metadata = $this->createFactory()->loadMetadata($path);

        $this->assertInstanceOf('MediaGallery\Metadata\SoundMetadata', $metadata);
        $this->assertSame(realpath($path), $metadata->getRealPath());
        $this->assertSame(filemtime($path), $metadata->getCreatedAt());
        $this->assertSame(filesize($path), $metadata->getSize());
        $this->assertSame(18, $metadata->getDuration());
        $this->assertFalse($metadata->isLossless());
        $this->assertSame(64000, $metadata->getBitrate());
    }

    /** @expectedException \MediaGallery\MediaNotFoundException */
    public function testCannotLoadSoundMetadata()
    {
        $this->createFactory()->loadMetadata('/foo/bar.mp3');
    }

    private function createFactory()
    {
        return new SoundMetadataFactory(new AudioAnalyzer());
    }
}
