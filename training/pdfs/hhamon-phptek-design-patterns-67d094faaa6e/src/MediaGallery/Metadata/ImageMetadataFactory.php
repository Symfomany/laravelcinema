<?php

namespace MediaGallery\Metadata;

class ImageMetadataFactory extends MediaMetadataFactory
{
    /**
     * Creates the specific ImageMetadata object.
     *
     * @param \SplFileInfo $file
     *
     * @return ImageMetadata
     */
    protected function createMetadata(\SplFileInfo $file)
    {
        $metadata = $this->analyze($file);

        return new ImageMetadata($metadata['width'], $metadata['height']);
    }
}
