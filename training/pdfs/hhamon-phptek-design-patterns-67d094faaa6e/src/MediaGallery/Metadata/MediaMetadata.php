<?php

namespace MediaGallery\Metadata;

use MediaGallery\MediaMetadataInterface;

abstract class MediaMetadata implements MediaMetadataInterface
{
    private $realPath;
    private $size;
    private $createdAt;

    public function initialize(\SplFileInfo $file)
    {
        $this->size      = $file->getSize();
        $this->realPath  = $file->getRealPath();
        $this->createdAt = $file->getMTime();
    }

    public function getRealPath()
    {
        return $this->realPath;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
