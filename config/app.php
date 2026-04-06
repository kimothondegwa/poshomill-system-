<?php

return [
    'app_name' => env('APP_NAME', 'Posho Mill System'),
    'app_env' => env('APP_ENV', 'production'),
    'app_debug' => env('APP_DEBUG', false),
    'app_url' => env('APP_URL', 'http://localhost'),
    'app_timezone' => 'Africa/Nairobi',

    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',

    'log' => env('LOG_CHANNEL', 'stack'),
    'log_level' => env('LOG_LEVEL', 'debug'),
];
