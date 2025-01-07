<?php

namespace App\Controllers;

use App\Models\WorkflowModel;
use App\Models\ActivityLogModel;
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
            'status' => 'To Do',
            'assigned_user_ids' => json_encode($this->request->getPost('assigned_user_ids') ?? [])
        ];

        if ($this->model->save($data)) {
            // Log activity
            $this->logActivity($this->model->getInsertID(), "Workflow '{$data['name']}' created.");
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
        $workflow = $this->model->find($id);
        if (!$workflow) {
            return $this->failNotFound('Workflow not found.');
        }

        $data = $this->request->getRawInput();

        // Update the workflow
        if ($this->model->update($id, $data)) {
            // Log activity
            $this->logActivity($id, "Workflow '{$workflow['name']}' updated: " . json_encode($data));
            return $this->respondUpdated($data, 'Workflow updated successfully.');
        }

        return $this->fail('Failed to update workflow.');
    }

    public function updateStatus($id = null)
    {
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
            // Log activity
            $this->logActivity($id, "Status updated to '{$newStatus}' for workflow '{$workflow['name']}'.");
            return $this->respondUpdated(['id' => $id, 'status' => $newStatus], 'Workflow status updated successfully.');
        }
        
        return $this->fail('Failed to update status.');
    }

    public function updateAssignedUsers($id = null)
    {
        $workflow = $this->model->find($id);
        if (!$workflow) {
            return $this->failNotFound('Workflow not found.');
        }

        $assignedUsers = $this->request->getPost('assigned_user_ids');
        if (!is_array($assignedUsers)) {
            return $this->fail('Invalid assigned users format.');
        }

        if ($this->model->update($id, ['assigned_user_ids' => json_encode($assignedUsers)])) {
            // Log activity
            $this->logActivity($id, "Assigned users updated for workflow '{$workflow['name']}': " . json_encode($assignedUsers));
            return $this->respondUpdated(['id' => $id, 'assigned_user_ids' => $assignedUsers], 'Assigned users updated successfully.');
        }

        return $this->fail('Failed to update assigned users.');
    }

    public function delete($id = null)
    {
        $workflow = $this->model->find($id);
        if (!$workflow) {
            return $this->failNotFound('Workflow not found.');
        }

        if ($this->model->delete($id)) {
            // Log activity
            $this->logActivity($id, "Workflow '{$workflow['name']}' deleted.");
            return $this->respondDeleted(['id' => $id], 'Workflow deleted successfully.');
        }

        return $this->fail('Failed to delete workflow.');
    }

    // Fetch tasks grouped by status
    public function fetchTasksByStatus()
    {
        $tasks = $this->model->findAll();
        $groupedTasks = [
            'To Do' => [],
            'In Progress' => [],
            'In Evaluation' => [],
            'Finished' => []
        ];

        foreach ($tasks as $task) {
            $groupedTasks[$task['status']][] = $task;
        }

        return $this->respond($groupedTasks, 200);
    }

    // Log activity
    private function logActivity($workflowId, $description)
    {
        $activityLogModel = new ActivityLogModel();
        $activityLogModel->insert([
            'workflow_id' => $workflowId,
            'description' => $description
        ]);
    }
}
