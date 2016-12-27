<?php

use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\Yui\JsCompressorFilter;

// Don't load on dev
if (APPLICATION_ENV === 'development') {
    return [];
}

// Set paths
if (!defined('APPLICATION_PATH_JAVA')) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $javaPath = 'C:\ProgramData\Oracle\Java\javapath\java.exe';
    } else {
        $javaPath = '/usr/bin/java';
    }
    define('APPLICATION_PATH_JAVA', $javaPath);
}

defined('APPLICATION_PATH_YUI') || define(
    'APPLICATION_PATH_YUI',
    realpath('vendor/nervo/yuicompressor/yuicompressor.jar')
);

// Compressor functions
$cssCompressor = function () {
    return new CssCompressorFilter(APPLICATION_PATH_YUI, APPLICATION_PATH_JAVA);
};
$jsCompressor = function () {
    return new JsCompressorFilter(APPLICATION_PATH_YUI, APPLICATION_PATH_JAVA);
};

// Return config
return [
    'factories'          => [
        'bootstrap_compressor_css' => $cssCompressor,
        'bootstrap_compressor_js'  => $jsCompressor,
    ],
];
