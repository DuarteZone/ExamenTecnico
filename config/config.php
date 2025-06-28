<?php
// Este archivo de configuración es utilizado para establecer la conexión a la base de datos.
// Los valores por defecto son para una base de datos MySQL local.
// Puedes sobrescribir estos valores utilizando variables de entorno en tu archivo .env.
// Asegúrate de que las variables de entorno estén definidas correctamente en tu entorno de
// desarrollo o producción para que la aplicación pueda conectarse a la base de datos sin problemas.

return [
    'db' => [
        'host'     => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'name'     => $_ENV['DB_NAME'] ?? 'taskflow',
        'user'     => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASS'] ?? '',
        'charset'  => 'utf8mb4'
    ]
];
