<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

// 👉 idagdag dito ang custom filter mo
use App\Filters\AdminFilter;
use App\Filters\AuthFilter;

class Filters extends BaseFilters
{
    /**
     * Aliases para mas madaling gamitin ang filters sa routes
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,

        // 👉 custom filters
        'auth'          => \App\Filters\AuthFilter::class,
        'adminfilter'   => \App\Filters\AdminFilter::class,
    ];

    /**
     * Required filters (framework-level)
     */
    public array $required = [
        'before' => [
            // 'forcehttps', // enable kung kailangan ng HTTPS
        ],
        'after' => [
            'toolbar', // Debug Toolbar
        ],
    ];

    /**
     * Global filters (lahat ng routes apektado)
     */
    public array $globals = [
        'before' => [
            // 'csrf',
            // 'honeypot',
        ],
        'after' => [
            // 'secureheaders',
        ],
    ];

    /**
     * Filters per HTTP method (optional)
     */
    public array $methods = [];

    /**
     * Filters by URI patterns
     */
    public array $filters = [
        // lahat ng admin routes dadaan sa adminfilter
        'adminfilter' => [
            'before' => ['admin/*'],
        ],

        // lahat ng authenticated routes dadaan sa auth filter
        'auth' => [
            'before' => [
                'doctor/*',
                'nurse/*',
                'receptionist/*',
                'lab/*',
                'pharmacy/*',
                'accounting/*',
                'it/*',
            ],
        ],
    ];
}
