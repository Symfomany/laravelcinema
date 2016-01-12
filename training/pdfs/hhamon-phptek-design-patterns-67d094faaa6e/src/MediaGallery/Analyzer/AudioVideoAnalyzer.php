<?php

namespace MediaGallery\Analyzer;

use GetId3\GetId3Core as MediaAnalyzer;

abstract class AudioVideoAnalyzer implements MediaAnalyzerInterface
{
    public function analyze(\SplFileInfo $file)
    {
        $path = $file->getRealPath();
        $metadata = $this->createAnalyzer()->analyze($path);

        if (!$metadata || isset($metadata['error'])) {
            throw new AnalysisFailedException(sprintf(
                'Unable to get audio/video metadata from file %s.',
                $path
            ));
        }

        return $this->createAnalysisReport($file, $metadata);
    }

    abstract protected function createAnalysisReport(\SplFileInfo $file, array $metadata);

    private function createAnalyzer()
    {
        $analyzer = new MediaAnalyzer();
        $analyzer
            ->setOptionMD5Data(true)
            ->setOptionMD5DataSource(true)
            ->setEncoding('UTF-8')
        ;

        return $analyzer;
    }
} 
