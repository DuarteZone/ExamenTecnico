<?php
use PHPUnit\Framework\TestCase;
use App\Repositories\TaskRepository;
use App\Models\Task;


/**
 * TaskRepositoryTest
 * Clase de prueba para verificar el funcionamiento del repositorio de tareas.
 * Utiliza PHPUnit para realizar pruebas unitarias.
 * @package App\Tests
 * @author Joc Duarte
 */

class TaskRepositoryTest extends TestCase
{
    private TaskRepository $repo;

    protected function setUp(): void
    {
        $this->repo = new TaskRepository();
    }

    public function testCreateAndFindTask()
    {
        $task = new Task();
        $task->user_id = 1;
        $task->title = "Test Task";
        $task->description = "Testing create task";
        $task->status = "pending";
        $task->due_date = date('Y-m-d', strtotime('+1 day'));

        $id = $this->repo->create($task);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);

        $foundTask = $this->repo->findById($id, 1);
        $this->assertNotNull($foundTask);
        if (is_array($foundTask)) {
            $this->assertEquals($task->title, $foundTask['title']);
        } else {
            $this->assertEquals($task->title, $foundTask->title);
        }
    }
}
