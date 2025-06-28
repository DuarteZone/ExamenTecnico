<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Env;

Env::load(__DIR__ . '/../.env');

// Ejemplo de routing básico
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/../routes/api.php';
