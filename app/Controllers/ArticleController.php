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
        $articleModel = new ArticleModel();
        $articles = $articleModel->findAll(); // Fetch all articles

        return view('articles/index', ['articles' => $articles]);
    }

    public function new()
    {
        // Render the form view for creating a new article
        return view('articles/new');
    }

    public function create()
    {
        // Define validation rules
        $rules = [
            'title' => 'required|max_length[255]',
            'content' => 'required',
        ];

        // Validate input
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Prepare data for saving
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'author_id' => session()->get('user_id'), // Use logged-in user's ID
            'status' => 'draft', // Default status
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Save the article using a helper method
        if ($this->saveArticle($data)) {
            // Redirect to articles with success message
            return redirect()->to('/articles')->with('success', 'Article created successfully!');
        }

        // Return error if saving fails
        return redirect()->back()->with('error', 'Failed to create article.');
    }

    /**
     * Save the article to the database.
     */
    private function saveArticle(array $data)
    {
        return $this->model->insert($data);
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