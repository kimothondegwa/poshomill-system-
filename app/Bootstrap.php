<?php

namespace App;

/**
 * Bootstrap helper class for Laravel application
 * This file is kept for reference only - use bootstrap/app.php instead
 */
class Bootstrap
{
    public static function create()
    {
        // Use bootstrap/app.php for application bootstrapping
        return require dirname(__DIR__) . '/bootstrap/app.php';
    }
}
