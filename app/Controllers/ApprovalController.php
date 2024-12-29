<?php

namespace App\Controllers;

use App\Models\ApprovalModel;
use CodeIgniter\RESTful\ResourceController;

class ApprovalController extends ResourceController
{
    protected $modelName = 'App\\Models\\ApprovalModel';
    protected $format = 'json';

    public function create()
    {
        $data = [
            'article_id' => $this->request->getPost('article_id'),
            'approver_id' => session()->get('user_id'),
            'status' => 'pending',
            'comments' => $this->request->getPost('comments'),
        ];

        if ($this->model->save($data)) {
            return $this->respondCreated($data, 'Approval request created successfully.');
        }

        return $this->fail('Failed to create approval request.');
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Approval updated successfully.');
        }

        return $this->fail('Failed to update approval.');
    }
}
?>