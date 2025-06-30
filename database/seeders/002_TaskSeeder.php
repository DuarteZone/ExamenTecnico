<?php

require_once __DIR__ . '/../../vendor/autoload.php';

/* * Seeder para crear tareas de prueba.
 * Este script utiliza Faker para generar datos aleatorios y poblar la tabla de tareas.
 * Crea 20 tareas asignadas a usuarios aleatorios con un título, descripción, estado y fecha de vencimiento.
 * @package App\Core
 * @author Joc Duarte
 */

use App\Core\Env;
use App\Core\Database;
use Faker\Factory;

Env::load(__DIR__ . '/../../.env');
$pdo = Database::connect();
$faker = Factory::create();

$statuses = ['pending', 'in_progress', 'completed'];

// Obtener todos los IDs de usuarios
$userIds = $pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);

if (empty($userIds)) {
    echo "No hay usuarios para asignar tareas. Ejecuta primero el UserSeeder.\n";
    exit;
}

$sql = "INSERT INTO tasks (user_id, title, description, status, due_date) 
        VALUES (:user_id, :title, :description, :status, :due_date)";
$stmt = $pdo->prepare($sql);

for ($i = 1; $i <= 20; $i++) {
    $stmt->execute([
        'user_id' => $userIds[array_rand($userIds)],
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(),
        'status' => $statuses[array_rand($statuses)],
        'due_date' => $faker->date('Y-m-d', '+30 days'),
    ]);
}

echo "Seeder ejecutado correctamente: 20 tareas generadas para usuarios aleatorios.\n";
