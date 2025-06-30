<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\User;
use PDO;

class UserRepository
{
    private \PDO $db;
    /**
     * UserRepository para manejar las operaciones de usuarios en la base de datos.
     * Este repositorio maneja la creación y búsqueda de usuarios por email.
     * Utiliza la clase Database para conectarse a la base de datos y realizar las operaciones necesarias.
     * @package App\Repositories
     * @author Joc Duarte
     */

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->mapToUser($data) : null;
    }

    public function create(User $user): int
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, name, password) VALUES (?, ?, ?)");
        $stmt->execute([$user->email, $user->name, $user->password]);
        return (int) $this->db->lastInsertId();
    }

    private function mapToUser(array $data): User
    {
        $user = new User();
        $user->id = (int) $data['id'];
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->password = $data['password'];
        return $user;
    }
}
