<?php
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
