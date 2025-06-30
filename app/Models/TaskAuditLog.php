<?php


namespace App\Models;

/**
 * TaskAuditLog modelo que representa el registro de auditoría de cambios en las tareas.
 * Este modelo define las propiedades de un registro de auditoría y su estructura.
 * @package App\Models
 * @author Joc Duarte
 */

use PDO;

class TaskAuditLog
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(int $taskId, string $oldStatus, string $newStatus): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO task_audit_log (task_id, old_status, new_status)
            VALUES (:task_id, :old_status, :new_status)
        ");

        $stmt->execute([
            'task_id' => $taskId,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
        ]);
    }

    public function getByTaskId(int $taskId): array
    {
        $stmt = $this->db->prepare("
        SELECT old_status, new_status, changed_at
        FROM task_audit_log
        WHERE task_id = :task_id
        ORDER BY changed_at DESC
    ");
        $stmt->execute(['task_id' => $taskId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
