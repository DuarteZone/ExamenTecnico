<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Env;
use App\Core\Database;

Env::load(__DIR__ . '/.env');
$pdo = Database::connect();

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;
SQL;

try {
    $pdo->exec($sql);
    echo "Tabla 'users' creada correctamente.\n";
} catch (PDOException $e) {
    echo "Error al crear tabla: " . $e->getMessage();
}

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    due_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=INNODB;
SQL;

$pdo->exec($sql);
echo "Tabla 'tasks' creada correctamente.\n";
