<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\RESTful\ResourceController;

class TaskController extends ResourceController
{
    protected $modelName = 'App\\Models\\TaskModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll(), 200);
    }

    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'assigned_to' => $this->request->getPost('assigned_to'),
            'status' => 'pending',
            'priority' => $this->request->getPost('priority'),
            'workflow_id' => $this->request->getPost('workflow_id'),
        ];

        if ($this->model->save($data)) {
            return $this->respondCreated($data, 'Task created successfully.');
        }

        return $this->fail('Failed to create task.');
    }

    public function show($id = null)
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->failNotFound('Task not found.');
        }

        return $this->respond($task, 200);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Task updated successfully.');
        }

        return $this->fail('Failed to update task.');
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id], 'Task deleted successfully.');
        }

        return $this->fail('Failed to delete task.');
    }
}
?>