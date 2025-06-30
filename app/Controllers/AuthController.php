<?php

namespace App\Controllers;

use App\Services\AuthService;
/**
 * * AuthController donde se manejan las peticiones de autenticación
 * * Este controlador maneja el registro y el inicio de sesión de los usuarios.
 * * Utiliza el servicio AuthService para realizar las operaciones de autenticación.
 * * * @package App\Controllers
 * @author Joc Duarte
 */

class AuthController
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function register()
    {
        // Verifica si el cuerpo de la solicitud contiene datos JSON
        // y decodifica el JSON recibido
        // Si no se puede decodificar, devuelve un error 400
        // y un mensaje de error en formato JSON.
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data['email'] || !$data['name'] || !$data['password']) {
            http_response_code(400);
            echo json_encode(['error' => 'Campos requeridos']);
            return;
        }
        // Verifica si el email ya está registrado
        //
        $token = $this->auth->register($data);
        echo json_encode(['token' => $token]);
    }

    /**
     * Maneja el inicio de sesión de un usuario.
     * Espera recibir un JSON con 'email' y 'password'.
     * Si las credenciales son válidas, devuelve un token JWT.
     * Si las credenciales son inválidas, devuelve un error 401.
     */

   public function login()
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo decodificar el JSON']);
        return;
    }

    if (empty($data['email']) || empty($data['password'])) {
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

    header('Content-Type: application/json'); // ← asegúrate de forzar el tipo de respuesta
    echo json_encode(['token' => $token]);
}

}
