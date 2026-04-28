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

class Filters extends BaseFilters
{
    /**
     * Semua alias filter - JANGAN hapus yang default CI4
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
        // Custom filter kita
        'auth'          => \App\Filters\AuthFilter::class,
        'admin'         => \App\Filters\AdminFilter::class,
    ];

    /**
     * Global filters
     * JANGAN tambahkan forcehttps di sini untuk localhost
     */
    public array $globals = [
        'before' => [
            // 'forcehttps', // dinonaktifkan untuk localhost
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'secureheaders',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}