<?php

namespace MediaGallery\Metadata;

class MovieMetadataFactory extends MediaMetadataFactory
{
    /**
     * Creates the specific MovieMetadata object.
     *
     * @param  \SplFileInfo $file
     * @return MovieMetadata
     */
    protected function createMetadata(\SplFileInfo $file)
    {
        $metadata = $this->analyze($file);

        return new MovieMetadata(
            $metadata['resolution_x'],
            $metadata['resolution_y'],
            $metadata['duration'],
            $metadata['frame_rate'],
            $metadata['frame_count']
        );
    }
}
