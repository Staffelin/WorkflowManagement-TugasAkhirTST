<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [
        'csrf' => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'auth' => \App\Filters\AuthFilter::class, // Register the auth filter
    ];

    public $globals = [
        'before' => [
            // Add global filters here
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public $methods = [
        // Define HTTP method-specific filters here
    ];

    public $filters = [
        // Apply the auth filter to specific routes
        'auth' => ['before' => ['/dashboard', '/profile', '/articles', '/workflows']],
    ];
}
