<?php

namespace MediaGallery\Metadata;

use MediaGallery\Analyzer\MediaAnalyzerInterface;
use MediaGallery\MediaMetadataFactoryInterface;
use MediaGallery\MediaMetadataInterface;
use MediaGallery\MediaNotFoundException;

abstract class MediaMetadataFactory implements MediaMetadataFactoryInterface
{
    private $analyzer;

    /**
     * Constructor.
     *
     * @param MediaAnalyzerInterface $analyzer A multimedia file analyzer
     */
    public function __construct(MediaAnalyzerInterface $analyzer)
    {
        $this->analyzer = $analyzer;
    }

    /**
     * Loads the metadata of a given multimedia file. 
     *
     * @param string $path The multimedia file path
     *
     * @return MediaMetadataInterface $metadata The metadata instance
     * @throws MediaNotFoundException
     */
    public function loadMetadata($path)
    {
        if (!is_readable($path)) {
            throw new MediaNotFoundException(sprintf(
                'Media file %s does not exist or is not readable.',
                $path
            ));
        }

        $file = new \SplFileInfo($path);

        $metadata = $this->createMetadata($file);
        $metadata->initialize($file);

        return $metadata;
    }

    /**
     * Creates the specific media metadata object.
     *
     * This is the factory method to be implemented by
     * each concrete MediaMetadadaFactory class.
     *
     * @param \SplFileInfo $file
     * @return MediaMetadataInterface
     */
    abstract protected function createMetadata(\SplFileInfo $file);

    /**
     * Analyzes the metadata of a multimedia file.
     *
     * @param \SplFileInfo $file The multimedia file
     * @return array             The analysis report
     */
    protected function analyze(\SplFileInfo $file)
    {
        return $this->analyzer->analyze($file);
    }
}
