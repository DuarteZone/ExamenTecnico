<?php

namespace App\Models;

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
