<?php

namespace MediaGallery\Analyzer;

class VideoAnalyzer extends AudioVideoAnalyzer
{
    protected function createAnalysisReport(\SplFileInfo $file, array $metadata)
    {
        $format = $metadata['video']['dataformat'];

        return [
            'resolution_x' => $metadata['video']['resolution_x'],
            'resolution_y' => $metadata['video']['resolution_y'],
            'duration'     => $metadata['playtime_seconds'],
            'frame_rate'   => $metadata['video']['frame_rate'],
            'frame_count'  => $metadata[$format]['video']['frame_count'],
        ];
    }
}
