<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Env;
use App\Core\Database;
use Faker\Factory;

Env::load(__DIR__ . '/.env');
$pdo = Database::connect();



$faker = Factory::create();
$userId = 1; 
$statuses = ['pending', 'in_progress', 'completed'];

$sql = "INSERT INTO tasks (user_id, title, description, status, due_date) 
        VALUES (:user_id, :title, :description, :status, :due_date)";
$stmt = $pdo->prepare($sql);

for ($i = 1; $i <= 20; $i++) {
    $stmt->execute([
        'user_id' => $userId,
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(),
        'status' => $statuses[array_rand($statuses)],
        'due_date' => $faker->date('Y-m-d', '+30 days'),
    ]);
}

echo "Seeder ejecutado correctamente: 20 tareas generadas.\n";
