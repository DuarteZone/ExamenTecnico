<?php

/**
 * Database clase para manejar la conexión a la base de datos.
 * * Esta clase utiliza PDO para conectarse a una base de datos MySQL.
 * * @package App\Core
 * @author Joc Duarte
 * 
 */

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public static function connect(): PDO
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/config.php';

            // Verifica que la configuración de la base de datos esté completa
            // y que los valores necesarios estén presentes
            

            $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset={$config['db']['charset']}";

            try {
                self::$pdo = new PDO($dsn, $config['db']['user'], $config['db']['password']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("DB Connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
