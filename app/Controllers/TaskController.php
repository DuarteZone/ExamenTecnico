<?php

namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use App\Models\Task;
use App\Repositories\TaskRepository;

use App\Core\Database;

use PDO;

class TaskController
{
      private \PDO $db;
    
    private TaskRepository $repo;

    public function __construct()
    {
        $this->repo = new TaskRepository();
        $this->db = Database::connect();
    }

    public function index()
    {
        header('Content-Type: application/json');

        $user = \App\Middlewares\AuthMiddleware::check();

        $filters = [
            'status' => $_GET['status'] ?? null,
            'due_date' => isset($_GET['due_date']) ? date('Y-m-d', strtotime($_GET['due_date'])) : null,
            'sort' => $_GET['sort'] ?? 'desc',
            'page' => $_GET['page'] ?? 1,
            'limit' => $_GET['limit'] ?? 10
        ];

        $tasks = $this->repo->getByUserWithFilters($user->sub, $filters);


        echo json_encode($tasks);
        exit;
    }







    public function store()
    {
        $user = AuthMiddleware::check();
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data['title'] || !$data['status'] || !$data['due_date']) {
            http_response_code(400);
            echo json_encode(['error' => 'Campos requeridos']);
            return;
        }

        $task = new Task();
        $task->user_id = $user->sub;
        $task->title = $data['title'];
        $task->description = $data['description'] ?? '';
        $task->status = $data['status'];
        $task->due_date = $data['due_date'];

        $id = $this->repo->create($task);
        echo json_encode(['message' => 'Tarea creada', 'id' => $id]);
    }

    public function update($id)
    {
        $user = AuthMiddleware::check();
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data['title'] || !$data['status'] || !$data['due_date']) {
            http_response_code(400);
            echo json_encode(['error' => 'Campos requeridos']);
            return;
        }

        $ok = $this->repo->update($id, $user->sub, $data);
        echo json_encode(['updated' => $ok]);
    }

    public function destroy($id)
    {
        $user = AuthMiddleware::check();
        $ok = $this->repo->delete($id, $user->sub);
        echo json_encode(['deleted' => $ok]);
    }

    public function show($id)
    {
        $user = AuthMiddleware::check();
        $task = $this->repo->findById($id, $user->sub);

        if (!$task) {
            http_response_code(404);
            echo json_encode(['error' => 'No encontrada']);
            return;
        }

        echo json_encode($task);
    }
    public function audit($id)
    {
        header('Content-Type: application/json');

        $user = \App\Middlewares\AuthMiddleware::check();

        // Validar que la tarea sea del usuario
        $stmt = $this->db->prepare("SELECT id FROM tasks WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['id' => $id, 'user_id' => $user->sub]);
        $task = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$task) {
            http_response_code(404);
            echo json_encode(['error' => 'Tarea no encontrada']);
            return;
        }

        $auditLog = new \App\Models\TaskAuditLog($this->db);
        $logs = $auditLog->getByTaskId($id);

        echo json_encode($logs);
    }
}
