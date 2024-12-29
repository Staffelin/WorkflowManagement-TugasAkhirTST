<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovalModel extends Model
{
    protected $table = 'approvals';
    protected $primaryKey = 'id';
    protected $allowedFields = ['article_id', 'approver_id', 'status', 'comments', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
