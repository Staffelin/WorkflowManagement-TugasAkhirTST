<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'author_id', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
