<?php

/**
 * @var mixed $pdo
 * Este script crea la tabla 'users' en la base de datos.
 * Asegúrate de que la conexión a la base de datos esté establecida correctamente
 * antes de ejecutar este script.
 * Si la tabla ya existe, no se creará de nuevo.
 * Este script utiliza la sintaxis de SQL para crear la tabla con las siguientes columnas:
 * - id: entero, autoincremental, clave primaria.
 * - email: cadena de texto, no nulo, único.
 * - name: cadena de texto, no nulo.
 * - password: cadena de texto, no nulo.
 * - created_at: marca de tiempo, por defecto la fecha y hora actual.
 * - updated_at: marca de tiempo, por defecto la fecha y hora actual, se actualiza automáticamente al modificar el registro.
 * La tabla utiliza el motor de almacenamiento InnoDB para garantizar
 * la integridad referencial y el soporte de transacciones.
 * @package App\Core
 * @author Joc Duarte
 */
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

$pdo->exec($sql);
echo "→ Tabla 'users' creada.\n";
