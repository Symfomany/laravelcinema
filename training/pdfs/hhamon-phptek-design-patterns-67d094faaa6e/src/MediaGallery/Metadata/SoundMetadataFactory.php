<?php

namespace MediaGallery\Metadata;

class SoundMetadataFactory extends MediaMetadataFactory
{
    /**
     * Creates the specific SoundMetadata object.
     *
     * @param \SplFileInfo $file
     *
     * @return SoundMetadata
     */
    protected function createMetadata(\SplFileInfo $file)
    {
        $metadata = $this->analyze($file);

        return new SoundMetadata($metadata['bitrate'], $metadata['duration'], $metadata['lossless']);
    }
}
