<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkflowModel extends Model
{
    protected $table = 'workflows';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'created_by', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
