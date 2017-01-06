<?php

return [
    'resolver_configs' => [
        'collections' => [
            /* Master collections */
            'css/master.css'  => [
                'css/bootstrap.css',
                'css/bootstrap-theme.css',
                'css/bootstrap-global.css',
                'css/bootstrap-queries.css',
            ],
            'js/master.js'    => [
                'js/jquery.min.js',
                'js/bootstrap.js',
                'js/jquery-timeago.js',
                'js/bootstrap-global.js',
            ],
            /* JS Fixes */
            'js/fix/ltIE9.js' => [
                'js/html5shiv.js',
                'js/respond.js',
            ],
        ],
        'paths'       => [
            __DIR__ . '/../assets',
        ],
        'map'         => [
            /* FONTS */
            'fonts/glyphicons-halflings-regular.eot'   => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/fonts/glyphicons-halflings-regular.eot',
            'fonts/glyphicons-halflings-regular.svg'   => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/fonts/glyphicons-halflings-regular.svg',
            'fonts/glyphicons-halflings-regular.ttf'   => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/fonts/glyphicons-halflings-regular.ttf',
            'fonts/glyphicons-halflings-regular.woff'  => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/fonts/glyphicons-halflings-regular.woff',
            'fonts/glyphicons-halflings-regular.woff2' => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/fonts/glyphicons-halflings-regular.woff2',
            /* CSS */
            'css/bootstrap.css'                        => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.css',
            'css/bootstrap.css.map'                    => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.css.map',
            'css/bootstrap-theme.css'                  => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap-theme.css',
            'css/bootstrap-theme.css.map'              => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap-theme.css.map',
            'css/bootstrap-global.css'                 => __DIR__ . '/../assets/css/bootstrap-global.css',
            /* JS */
            'js/jquery.min.js'                         => 'http://code.jquery.com/jquery-2.2.4.min.js',
            'js/jquery-timeago.js'                     => 'http://timeago.yarp.com/jquery.timeago.js',
            'js/bootstrap.js'                          => 'http://maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.js',
            'js/bootlint.js'                           => 'http://maxcdn.bootstrapcdn.com/bootlint/latest/bootlint.js',
            'js/html5shiv.js'                          => 'http://oss.maxcdn.com/html5shiv/latest/html5shiv.js',
            'js/respond.js'                            => 'http://oss.maxcdn.com/respond/latest/respond.src.js',
            'js/bootstrap-global.js'                   => __DIR__ . '/../assets/js/bootstrap-global.js',
        ],
    ],
    'filters'          => [
        'js'  => [
            ['service' => 'bootstrap_compressor_js'],
        ],
        'css' => [
            ['service' => 'bootstrap_compressor_css'],
        ],
    ],
    'caching' => [
        'default' => [
            'cache' => 'Filesystem',
            'options' => [
                'dir' => 'data/cache/assets'
            ],
        ],
    ],
];
