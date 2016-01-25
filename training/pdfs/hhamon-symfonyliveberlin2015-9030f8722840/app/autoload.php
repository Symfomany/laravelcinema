<?php

use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('dump')) {
    function dump($var)
    {
        foreach (func_get_args() as $var) {
            VarDumper::dump($var);
        }
    }
}

/*
 * @var ClassLoader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
