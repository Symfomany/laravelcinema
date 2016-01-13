<?php

namespace MediaGallery\Analyzer;

class ImageAnalyzer implements MediaAnalyzerInterface
{
    public function analyze(\SplFileInfo $file)
    {
        $path = $file->getRealPath();
        if (!$path || !$metadata = getimagesize($path)) {
            throw new AnalysisFailedException(sprintf(
                'Unable to extract image metadata for path %s.',
                $path
            ));
        }

        return [
            'width'  => $metadata[0],
            'height' => $metadata[1],
        ];
    }
}
