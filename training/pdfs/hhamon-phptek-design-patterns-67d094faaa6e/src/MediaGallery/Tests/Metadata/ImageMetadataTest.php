<?php

namespace MediaGallery\Tests\Metadata;

use MediaGallery\Metadata\ImageMetadata;

class ImageMetadataTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideImageDimensions */
    public function testCreateImageMetadata($orientation, $width, $height)
    {
        $metadata = new ImageMetadata($width, $height);

        $this->assertSame($width, $metadata->getWidth());
        $this->assertSame($height, $metadata->getHeight());
        $this->assertSame($orientation, $metadata->getOrientation());
    }

    public function provideImageDimensions()
    {
        return [
            [ 'landscape', 500, 100 ],
            [ 'landscape', 500, 499 ],
            [ 'portrait', 100, 500 ],
            [ 'portrait', 99, 100 ],
            [ 'square', 100, 100 ],
        ];
    }

    public function testCreateMetadataForSquareOrientedImage()
    {

    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideInvalidDimensions
     */
    public function testCreateImageMetadataWithInvalidImageDimensions($width, $height)
    {
        new ImageMetadata($width, $height);
    }

    public function provideInvalidDimensions()
    {
        return [
            [ 0, 100 ],
            [ 100, 0 ],
            [ 0, 0 ],
            [ -10, 100 ],
            [ 100, -100 ],
        ];
    }
}
