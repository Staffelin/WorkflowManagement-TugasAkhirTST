<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\RESTful\ResourceController;

class DashboardController extends ResourceController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $articleModel = new ArticleModel();
        $articles = $articleModel->where('author_id', $userId)->findAll();

        return $this->respond(['articles' => $articles], 200);
    }
}
?>