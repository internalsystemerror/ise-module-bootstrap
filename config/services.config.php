<?php

namespace Ise\Bootstrap;

use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\Yui\JsCompressorFilter;

return [
    'aliases'   => [
        __NAMESPACE__ . '\Compressor\Css' => CssCompressorFilter::class,
        __NAMESPACE__ . '\Compressor\Js'  => JsCompressorFilter::class,
    ],
    'factories' => [
        Listener\DispatchListener::class => Factory\DispatchListenerFactory::class,
        CssCompressorFilter::class       => Factory\CompressorFilterFactory::class,
        JsCompressorFilter::class        => Factory\CompressorFilterFactory::class,
    ],
];
