<?php

namespace MediaGallery;

interface MediaMetadataInterface
{
    public function initialize(\SplFileInfo $file);
    public function getRealPath();
    public function getSize();
    public function getCreatedAt();
}
