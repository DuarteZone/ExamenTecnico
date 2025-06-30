<?php

namespace App\Models;

/**
 * Task modelo que representa una tarea en el sistema.
 * Este modelo define las propiedades de una tarea y su estructura.
 * @package App\Models
 * @author Joc Duarte
 */

class Task
{
    public int $id;
    public int $user_id;
    public string $title;
    public string $description;
    public string $status;
    public string $due_date;
    public string $created_at;
    public string $updated_at;
}
