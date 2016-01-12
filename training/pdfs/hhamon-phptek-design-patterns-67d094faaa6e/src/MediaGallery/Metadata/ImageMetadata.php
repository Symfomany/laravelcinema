<?php

namespace MediaGallery\Metadata;

class ImageMetadata extends MediaMetadata
{
    const SQUARE    = 'square';
    const PORTRAIT  = 'portrait';
    const LANDSCAPE = 'landscape';

    private $width;
    private $height;

    /**
     * Constructor.
     *
     * @param int $width  The image's width in pixels
     * @param int $height The image's height in pixels
     */
    public function __construct($width, $height)
    {
        if (!is_int($width) || $width < 1) {
            throw new \InvalidArgumentException(sprintf(
                '$width must be a valid integer, %s given.',
                gettype($width)
            ));
        }

        if (!is_int($height) || $height < 1) {
            throw new \InvalidArgumentException(sprintf(
                '$height must be a valid integer, %s given.',
                gettype($height)
            ));
        }

        $this->width  = $width;
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getOrientation()
    {
        if ($this->width === $this->height) {
            return self::SQUARE;
        }

        return $this->width > $this->height ? self::LANDSCAPE : self::PORTRAIT;
    }
} 
