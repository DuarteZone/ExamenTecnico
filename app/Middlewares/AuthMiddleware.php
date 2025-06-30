<?php

namespace App\Middlewares;

/**
 * * AuthMiddleware para verificar la autenticación de los usuarios.
 * * Este middleware verifica si el token de autenticación está presente en los encabezados de la solicitud.
 * * Si el token es válido, permite el acceso al recurso solicitado.
 * * Si el token no es válido o no está presente, devuelve un error 401 (Unauthorized).
 * * @package App\Middlewares
 * @author Joc Duarte
 */

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
        $authService = new \App\Services\AuthService();
        $user = $authService->verifyToken($token);

        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido']);
            exit;
        }

        return $user;
    }
}
