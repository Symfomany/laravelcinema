<?php

namespace MediaGallery\Metadata;

class SoundMetadata extends MediaMetadata
{
    private $lossless;
    private $bitrate;
    private $duration;

    public function __construct($bitrate, $duration, $lossless)
    {
        $this->lossless = (bool) $lossless;
        $this->bitrate  = (int) $bitrate;
        $this->duration = (int) $duration;
    }

    public function getBitrate()
    {
        return $this->bitrate;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function isLossless()
    {
        return $this->lossless;
    }
}
