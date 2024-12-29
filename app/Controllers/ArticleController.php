<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\RESTful\ResourceController;

class ArticleController extends ResourceController
{
    protected $modelName = 'App\\Models\\ArticleModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll(), 200);
    }

    public function create()
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'author_id' => session()->get('user_id'),
            'status' => 'draft',
        ];

        if ($this->model->save($data)) {
            return $this->respondCreated($data, 'Article created successfully.');
        }

        return $this->fail('Failed to create article.');
    }

    public function show($id = null)
    {
        $article = $this->model->find($id);
        if (!$article) {
            return $this->failNotFound('Article not found.');
        }

        return $this->respond($article, 200);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Article updated successfully.');
        }

        return $this->fail('Failed to update article.');
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id], 'Article deleted successfully.');
        }

        return $this->fail('Failed to delete article.');
    }
}
?>