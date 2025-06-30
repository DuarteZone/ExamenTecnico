<?php

/**
 * API Routes
 * Este archivo define las rutas de la API del sistema TaskFlow.
 * Utiliza el patrón de diseño MVC para organizar las rutas y controladores.
 * @package App\Core
 * @author Joc Duarte
 */

use App\Controllers\AuthController;
use App\Controllers\TaskController;

$auth = new AuthController();

if ($requestUri === '/api/register' && $requestMethod === 'POST') {
    $auth->register();
}

if ($requestUri === '/api/login' && $requestMethod === 'POST') {
    $auth->login();
}



$task = new TaskController();

if ($requestUri === '/api/tasks' && $requestMethod === 'GET') {
    $task->index();
}

if ($requestUri === '/api/tasks' && $requestMethod === 'POST') {
    $task->store();
}

if (preg_match('#^/api/tasks/(\d+)/audit$#', $requestUri, $matches) && $requestMethod === 'GET') {
    $id = (int)$matches[1];
    $task->audit($id);
    return;
}

if (preg_match('#^/api/tasks/(\d+)$#', $requestUri, $matches)) {
    $id = (int)$matches[1];

    if ($requestMethod === 'GET') {
        $task->show($id);
    }

    if ($requestMethod === 'PUT') {
        $task->update($id);
    }

    if ($requestMethod === 'DELETE') {
        $task->destroy($id);
    }
}

