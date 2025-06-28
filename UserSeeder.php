<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Env;
use App\Core\Database;
use Faker\Factory;

Env::load(__DIR__ . '/.env');
$pdo = Database::connect();
$faker = Factory::create();

$sql = "INSERT INTO users (email, name, password) VALUES (:email, :name, :password)";
$stmt = $pdo->prepare($sql);

// Por ejemplo, creamos 5 usuarios con password '123456' hasheada con password_hash()
$passwordHash = password_hash('123456', PASSWORD_DEFAULT);

for ($i = 1; $i <= 5; $i++) {
    $stmt->execute([
        'email' => $faker->unique()->safeEmail(),
        'name' => $faker->name(),
        'password' => $passwordHash,
    ]);
}

echo "Seeder ejecutado correctamente: 5 usuarios generados.\n";