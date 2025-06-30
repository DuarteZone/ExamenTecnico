<?php
use PHPUnit\Framework\TestCase;
use App\Middlewares\AuthMiddleware;

class AuthTest extends TestCase
{
    public function testPasswordHashAndVerify()
    {
        $password = '123456';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->assertTrue(password_verify($password, $hash));
    }
}
