<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Task;
use PDO;

class TaskRepository
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function create(Task $task): int
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (user_id, title, description, status, due_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $task->user_id,
            $task->title,
            $task->description,
            $task->status,
            $task->due_date
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function getByUserWithFilters(int $userId, array $filters): array
    {
        header('Content-Type: application/json');
        $query = "SELECT * FROM tasks WHERE user_id = :user_id";
        $params = ['user_id' => $userId];

        if (!empty($filters['status'])) {
            $query .= " AND status = :status";
            $params['status'] = $filters['status'];
        }

        if (!empty($filters['due_date'])) {
            $query .= " AND due_date = :due_date";
            $params['due_date'] = $filters['due_date'];
        }

        $order = in_array(strtolower($filters['sort'] ?? ''), ['asc', 'desc']) ? $filters['sort'] : 'desc';
        $query .= " ORDER BY created_at $order";

        $limit = isset($filters['limit']) ? (int)$filters['limit'] : 10;
        $page = isset($filters['page']) ? (int)$filters['page'] : 1;
        $offset = ($page - 1) * $limit;

        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);

        foreach ($params as $key => $val) {
            $stmt->bindValue(":$key", $val, PDO::PARAM_STR); // <-- Forzar como string
        }

        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        error_log("QUERY: $query");
        error_log("PARAMS: " . print_r($params, true));

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function findById(int $id, int $userId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function update(int $id, int $userId, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, status = ?, due_date = ? WHERE id = ? AND user_id = ?");
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['status'],
            $data['due_date'],
            $id,
            $userId
        ]);
    }

    public function delete(int $id, int $userId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }
}
