<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

return [
    'view_manager'    => ['doctype' => 'HTML5',],
    'asset_manager'   => include __DIR__ . '/assets.config.php',
    'service_manager' => include __DIR__ . '/services.config.php',
    'view_helpers'    => include __DIR__ . '/helpers.config.php',
];
