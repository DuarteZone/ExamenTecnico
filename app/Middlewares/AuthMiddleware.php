<?php

namespace App\Middlewares;

use App\Services\AuthService;

class AuthMiddleware
{
    public static function check(): ?object
    {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Token requerido']);
            exit;
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $authService = new AuthService();
        $user = $authService->verifyToken($token);

        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido']);
            exit;
        }

        return $user;
    }
}
