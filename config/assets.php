<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Asset Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for local assets to ensure
    | the application works offline without external CDN dependencies.
    |
    */

    'local_assets' => [
        'css' => [
            'bootstrap' => 'build/assets/app-C8_NOOnd.css',
        ],
        'js' => [
            'bootstrap' => 'build/assets/app-D1IG_nlC.js',
        ],
    ],

    'fallback_cdn' => [
        'bootstrap_css' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        'bootstrap_js' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
    ],

    'offline_mode' => env('ASSETS_OFFLINE_MODE', true),
]; 