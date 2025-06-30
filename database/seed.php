<?php

require_once __DIR__ . '/../vendor/autoload.php';
/* * Script para ejecutar los seeders de la base de datos.
 * Este script carga las variables de entorno, conecta a la base de datos
 * y ejecuta todos los archivos de seeders encontrados en el directorio seeders.
 * @package App\Core
 * @author Joc Duarte
 */

use App\Core\Env;
use App\Core\Database;

Env::load(__DIR__ . '/../.env');
$pdo = Database::connect();

foreach (glob(__DIR__ . '/seeders/*.php') as $file) {
    require $file;
}

echo "Los Seeders se ejecutaron correctamente.\n";
