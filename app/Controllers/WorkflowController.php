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
        log_message('info', 'Received updateStatus request: ' . json_encode($this->request->getPost()));

        $workflow = $this->model->find($id);
        if (!$workflow) {
            return $this->failNotFound('Workflow not found.');
        }

        $newStatus = $this->request->getPost('status');
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
}
