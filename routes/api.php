<?php

use App\Controllers\AuthController;

$auth = new AuthController();

if ($requestUri === '/api/register' && $requestMethod === 'POST') {
    $auth->register();
}

if ($requestUri === '/api/login' && $requestMethod === 'POST') {
    $auth->login();
}
