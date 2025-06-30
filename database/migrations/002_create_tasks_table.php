<?php

/**
 * @var mixed $pdo
 * Este script crea la tabla 'tasks' en la base de datos.
 * Asegúrate de que la conexión a la base de datos esté establecida correctamente
 * antes de ejecutar este script.
 * Si la tabla ya existe, no se creará de nuevo.
 * Este script utiliza la sintaxis de SQL para crear la tabla con las siguientes columnas:
 * - id: entero, autoincremental, clave primaria.
 * - user_id: entero, no nulo, clave foránea que referencia a la tabla 'users'.
 * - title: cadena de texto, no nulo, título de la tarea.
 * - description: texto, descripción de la tarea.
 * - status: enumeración, estado de la tarea (pendiente, en progreso, completada), por defecto 'pendiente'.
 * - due_date: fecha, fecha de vencimiento de la tarea.
 * - created_at: marca de tiempo, por defecto la fecha y hora actual.
 * - updated_at: marca de tiempo, por defecto la fecha y hora actual, se actualiza automáticamente al modificar el registro.
 * La tabla utiliza el motor de almacenamiento InnoDB para garantizar
 * la integridad referencial y el soporte de transacciones.
 * @package App\Core
 * @author Joc Duarte
 */
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    due_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=INNODB;
SQL;

$pdo->exec($sql);
echo "→ Tabla 'tasks' creada.\n";
