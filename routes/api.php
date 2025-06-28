<?php

if ($requestUri === '/api/ping' && $requestMethod === 'GET') {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'pong']);
}
