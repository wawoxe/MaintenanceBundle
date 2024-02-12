<?php

declare(strict_types=1);

// Check if the autoloader file exists
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    // Require the autoloader file
    require dirname(__DIR__) . '/vendor/autoload.php';
}
