<?php
require_once __DIR__ . '/../vendor/autoload.php';
/* Este archivo se encarga de cargar las dependencias y configuraciones necesarias
 * para ejecutar las pruebas unitarias del sistema TaskFlow.
 * @package App\Tests
 * @author Joc Duarte
 */

use App\Core\Env;

// Carga el archivo .env
Env::load(__DIR__ . '/../.env');
