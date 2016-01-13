The Media Gallery System
========================

The Media Gallery System allows to extract metadata information from different
types of media files like movies, pictures and audios. Each type of media files
is supported by its related factory object to create its related metadata
object.

Usage
-----

Getting metadata from image files:

    :::php
    <?php
    
    use MediaGallery\Analyzer\ImageAnalyzer;
    use MediaGallery\Metadata\ImageMetadataFactory;
    
    $factory = new ImageMetadataFactory(new ImageAnalyzer());
    $metadata = $factory->loadMetadata('/path/to/image.png');
    
    echo 'Path:        ', $metadata->getRealPath()    ,"\n";
    echo 'Date:        ', $metadata->getCreatedAt()   ,"\n";
    echo 'Size:        ', $metadata->getSize()        ,"\n";
    echo 'Width:       ', $metadata->getWidth()       ," px\n";
    echo 'Height:      ', $metadata->getHeight()      ," px\n";
    echo 'Orientation: ', $metadata->getOrientation() ,"\n";

Getting metadata from video files:

    :::php
    <?php
    
    use MediaGallery\Analyzer\VideoAnalyzer;
    use MediaGallery\Metadata\MovieMetadataFactory;
    
    $factory  = new MovieMetadataFactory(new VideoAnalyzer());
    $metadata = $factory->loadMetadata('/path/to/movie.mp4');
    
    echo 'Path:         ', $metadata->getRealPath()    ,"\n";
    echo 'Date:         ', $metadata->getCreatedAt()   ,"\n";
    echo 'Size:         ', $metadata->getSize()        ,"\n";
    echo 'Resolution X: ', $metadata->getXResolution() ,' px ', "\n";
    echo 'Resolution Y: ', $metadata->getYResolution() ,' px ', "\n";
    echo 'Duration:     ', $metadata->getDuration()    ," seconds\n";
    echo 'Frame rate:   ', $metadata->getFrameRate()   ," fps\n";
    echo 'Frames:       ', $metadata->getFrameCount()  ," frames\n";


Getting metadata from audio files:

    :::php
    <?php
    
    use MediaGallery\Analyzer\VideoAnalyzer;
    use MediaGallery\Metadata\SoundMetadataFactory;
    
    $factory  = new SoundMetadataFactory(new AudioAnalyzer());
    $data = $factory->loadMetadata('/path/to/music.mp3');
    
    echo 'Path:     ', $data->getRealPath()    ,"\n";
    echo 'Date:     ', $data->getCreatedAt()   ,"\n";
    echo 'Size:     ', $data->getSize()        ,"\n";
    echo 'Duration: ', $data->getDuration()    ," s\n";
    echo 'Bit rate: ', $data->getBitrate()     ," Hz\n";
    echo 'Lossless: ', $data->isLossless() ? 'true' : 'false';

