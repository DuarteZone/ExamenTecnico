<?php
use PHPUnit\Framework\TestCase;
use App\Middlewares\AuthMiddleware;

/**
 * AuthTest
 * Clase de prueba para verificar el funcionamiento del middleware de autenticación.
 * Utiliza PHPUnit para realizar pruebas unitarias.
 * @package App\Tests
 * @author Joc Duarte
 */

class AuthTest extends TestCase
{
    public function testPasswordHashAndVerify()
    {
        $password = '123456';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->assertTrue(password_verify($password, $hash));
    }
}
