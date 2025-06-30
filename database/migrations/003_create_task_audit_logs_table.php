<?php

/**
 * @var mixed $pdo
 * Este script crea la tabla 'task_audit_log' en la base de datos.
 * Asegúrate de que la conexión a la base de datos esté establecida correctamente
 * antes de ejecutar este script.
 * Si la tabla ya existe, no se creará de nuevo.
 * Este script utiliza la sintaxis de SQL para crear la tabla con las siguientes columnas:
 * - id: entero, autoincremental, clave primaria.
 * - task_id: entero, no nulo, clave foránea que referencia a la tabla 'tasks'.
 * - old_status: enumeración, estado anterior de la tarea (pendiente, en progreso, completada), no nulo.
 * - new_status: enumeración, nuevo estado de la tarea (pendiente, en progreso, completada), no nulo.
 * - changed_at: marca de tiempo, por defecto la fecha y hora actual.
 * La tabla utiliza el motor de almacenamiento InnoDB para garantizar
 * la integridad referencial y el soporte de transacciones.
 * @package App\Core
 * @author Joc Duarte
 */
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS task_audit_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,
    old_status ENUM('pending', 'in_progress', 'completed') NOT NULL,
    new_status ENUM('pending', 'in_progress', 'completed') NOT NULL,
    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
) ENGINE=INNODB;
SQL;

$pdo->exec($sql);
echo "→ Tabla 'task_audit_log' creada.\n";
