<?php

namespace App\Controllers;

use App\Models\WorkflowModel;
use CodeIgniter\RESTful\ResourceController;

class WorkflowController extends ResourceController
{
    protected $modelName = 'App\\Models\\WorkflowModel';
    protected $format = 'json';

    public function index()
    {
        log_message('info', 'WorkflowController index method called.');

        $workflowModel = new WorkflowModel();
        $workflows = $workflowModel->findAll(); // Fetch all workflows

        return view('workflow/index', ['workflows' => $workflows]);
    }


    public function updateStatus($id = null)
    {
        // Log request data for debugging
        log_message('info', 'Received updateStatus request: ' . json_encode($this->request->getJSON()));

        $workflow = $this->model->find($id);
        if (!$workflow) {
            return $this->failNotFound('Workflow not found.');
        }

        $input = $this->request->getJSON();
        $newStatus = $input->status ?? null;
        $validStatuses = ['To Do', 'In Progress', 'In Evaluation', 'Finished'];

        if (!in_array($newStatus, $validStatuses)) {
            return $this->fail('Invalid status.');
        }

        if ($this->model->update($id, ['status' => $newStatus])) {
            log_message('info', "Workflow ID $id status updated to $newStatus.");
            return $this->respondUpdated(['id' => $id, 'status' => $newStatus], 'Workflow status updated successfully.');
        }

        return $this->fail('Failed to update status.');
    }

    // Temporary test method for debugging
    public function testUpdateStatus($id)
    {
        $this->model->update($id, ['status' => 'In Progress']);
        return 'Status updated to In Progress.';
    }

    public function create()
    {
        $articleModel = new \App\Models\ArticleModel();
        $userModel = new \App\Models\UserModel();
    
        $articles = $articleModel->findAll(); // Fetch all articles
        $users = $userModel->findAll(); // Fetch all users
    
        return view('workflow/create', ['articles' => $articles, 'users' => $users]);
    }
    
    public function store()
    {
        $input = $this->request->getJSON();
    
        // Log the received input
        log_message('info', 'Received input: ' . json_encode($input));
    
        // Validate input
        if (!isset($input->name, $input->description, $input->article_id, $input->user_id)) {
            log_message('error', 'Missing required fields: name, description, article_id, or user_id.');
            return $this->failValidationError('Missing required fields: name, description, article_id, or user_id.');
        }
    
        $data = [
            'name' => $input->name,
            'description' => $input->description,
            'status' => 'To Do', // Default status
            'created_by' => $input->user_id,
            'article_id' => $input->article_id,
            'user_id' => $input->user_id,
            'created_at' => date('Y-m-d H:i:s') // Add created_at explicitly
        ];
    
        // Log the data being inserted
        log_message('info', 'Data to be inserted: ' . json_encode($data));
    
        // Try inserting the data
        if ($this->model->insert($data)) {
            log_message('info', 'Workflow created successfully.');
            return $this->respondCreated(['message' => 'Workflow created successfully.']);
        }
    
        log_message('error', 'Failed to insert workflow into database.');
        return $this->fail('Failed to create workflow.');
    }
}