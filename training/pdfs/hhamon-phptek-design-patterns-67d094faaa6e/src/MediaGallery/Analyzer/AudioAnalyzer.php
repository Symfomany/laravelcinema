<?php

namespace MediaGallery\Analyzer;

class AudioAnalyzer extends AudioVideoAnalyzer
{
    protected function createAnalysisReport(\SplFileInfo $file, array $metadata)
    {
        return [
            'lossless' => $metadata['audio']['lossless'],
            'duration' => $metadata['playtime_seconds'],
            'bitrate'  => $metadata['bitrate'],
        ];
    }
}
