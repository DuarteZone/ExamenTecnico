<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    private UserRepository $userRepo;
    private string $jwtKey;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->jwtKey = $_ENV['JWT_SECRET'] ?? 'supersecret';
    }

    public function register(array $data): string
    {
        $user = new User();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);

        $userId = $this->userRepo->create($user);
        $user->id = $userId;

        return $this->generateToken($user);
    }

    public function login(array $data): ?string
    {
        $user = $this->userRepo->findByEmail($data['email']);
        if (!$user || !password_verify($data['password'], $user->password)) {
            return null;
        }

        return $this->generateToken($user);
    }

    private function generateToken(User $user): string
    {
        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + 3600
        ];

        return JWT::encode($payload, $this->jwtKey, 'HS256');
    }

    public function verifyToken(string $token): ?object
    {
        try {
            return JWT::decode($token, new Key($this->jwtKey, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}
