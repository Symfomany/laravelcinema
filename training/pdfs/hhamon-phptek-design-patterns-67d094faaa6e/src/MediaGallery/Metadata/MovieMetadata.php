<?php

namespace MediaGallery\Metadata;

class MovieMetadata extends MediaMetadata
{
    private $xResolution;
    private $yResolution;
    private $frameRate;
    private $frameCount;
    private $duration;

    public function __construct($xResolution, $yResolution, $duration, $frameRate, $frameCount)
    {
        $this->xResolution = (int) $xResolution;
        $this->yResolution = (int) $yResolution;
        $this->frameRate = (int) round($frameRate);
        $this->frameCount = (int) $frameCount;
        $this->duration = (int) round($duration);
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getFrameCount()
    {
        return $this->frameCount;
    }

    public function getFrameRate()
    {
        return $this->frameRate;
    }

    public function getXResolution()
    {
        return $this->xResolution;
    }

    public function getYResolution()
    {
        return $this->yResolution;
    }
}
