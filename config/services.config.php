<?php

namespace Ise\Bootstrap;

use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\Yui\JsCompressorFilter;
use Zend\Stdlib\ArrayUtils;

$services = [
    'factories' => [
        Listener\DispatchListener::class => Factory\DispatchListenerFactory::class,
    ],
];

// Don't load on dev
//if (APPLICATION_ENV === 'development') {
//    return $services;
//}

// Return config
return ArrayUtils::merge($services, [
    'aliases'   => [
        'bootstrap_compressor_css'        => __NAMESPACE__ . '\Compressor\Css',
        'bootstrap_compressor_js'         => __NAMESPACE__ . '\Compressor\Js',
        __NAMESPACE__ . '\Compressor\Css' => CssCompressorFilter::class,
        __NAMESPACE__ . '\Compressor\Js'  => JsCompressorFilter::class,
    ],
    'factories' => [
        CssCompressorFilter::class       => Factory\CompressorFilterFactory::class,
        JsCompressorFilter::class        => Factory\CompressorFilterFactory::class,
    ],
]);
