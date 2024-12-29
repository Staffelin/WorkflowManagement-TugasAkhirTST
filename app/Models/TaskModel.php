<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'assigned_to', 'status', 'priority', 'workflow_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
