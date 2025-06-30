<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Env;
use App\Core\Database;

Env::load(__DIR__ . '/../.env');
$pdo = Database::connect();

foreach (glob(__DIR__ . '/seeders/*.php') as $file) {
    require $file;
}

echo "Los Seeders se ejecutaron correctamente.\n";
