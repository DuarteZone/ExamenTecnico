<?php

require_once __DIR__ . '/migrate.php';
require_once __DIR__ . '/seed.php';

/* * Script para ejecutar las migraciones y seeders de la base de datos.
 * Este script carga las variables de entorno, conecta a la base de datos,
 * ejecuta todos los archivos de migración encontrados en el directorio migrations
 * y luego ejecuta los seeders para poblar la base de datos con datos de prueba.
 * @package App\Core
 * @author Joc Duarte
 */

echo "Las migraciones y seeders se ejecutaron correctamente.\n";
