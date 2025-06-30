<?php

require_once __DIR__ . '/../vendor/autoload.php';

/* * Script para ejecutar las migraciones de la base de datos.
 * Este script carga las variables de entorno, conecta a la base de datos
 * y ejecuta todos los archivos de migración encontrados en el directorio migrations.
 * @package App\Core
 * @author Joc Duarte
 */

use App\Core\Env;
use App\Core\Database;

Env::load(__DIR__ . '/../.env');
$pdo = Database::connect();

foreach (glob(__DIR__ . '/migrations/*.php') as $file) {
    require $file;
}

echo "Las migraciones se ejecutaron correctamente.\n";