<?php

namespace MediaGallery\Analyzer;

interface MediaAnalyzerInterface
{
    /**
     * Analyzes the metadata of a multimedia file.
     *
     * @param \SplFileInfo $file The multimedia file
     *
     * @return array The analysis report
     */
    public function analyze(\SplFileInfo $file);
}
