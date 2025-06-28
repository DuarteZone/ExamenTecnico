<?php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function register()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data['email'] || !$data['name'] || !$data['password']) {
            http_response_code(400);
            echo json_encode(['error' => 'Campos requeridos']);
            return;
        }

        $token = $this->auth->register($data);
        echo json_encode(['token' => $token]);
    }

    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data['email'] || !$data['password']) {
            http_response_code(400);
            echo json_encode(['error' => 'Credenciales requeridas']);
            return;
        }

        $token = $this->auth->login($data);
        if (!$token) {
            http_response_code(401);
            echo json_encode(['error' => 'Credenciales inválidas']);
            return;
        }

        echo json_encode(['token' => $token]);
    }
}
