<?php
return [
    'view_manager'  => [
        'doctype'             => 'HTML5',
        'template_map'        => [
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'asset_manager' => include __DIR__ . '/assets.config.php',
];
