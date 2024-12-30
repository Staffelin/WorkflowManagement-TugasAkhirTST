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
        $workflowModel = new WorkflowModel();
        $workflows = $workflowModel->findAll(); // Fetch all workflows

        return view('workflow/index', ['workflows' => $workflows]);
    }

    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'created_by' => session()->get('user_id'),
        ];

        if ($this->model->save($data)) {
            return $this->respondCreated($data, 'Workflow created successfully.');
        }

        return $this->fail('Failed to create workflow.');
    }

    public function show($id = null)
    {
        $workflow = $this->model->find($id);
        if (!$workflow) {
            return $this->failNotFound('Workflow not found.');
        }

        return $this->respond($workflow, 200);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Workflow updated successfully.');
        }

        return $this->fail('Failed to update workflow.');
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id], 'Workflow deleted successfully.');
        }

        return $this->fail('Failed to delete workflow.');
    }
}
?>