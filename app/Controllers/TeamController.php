<?php

namespace App\Controllers;

use App\Models\TeamModel;
use CodeIgniter\RESTful\ResourceController;

class TeamController extends ResourceController
{
    protected $modelName = 'App\\Models\\TeamModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll(), 200);
    }

    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'created_by' => session()->get('user_id'),
        ];

        if ($this->model->save($data)) {
            return $this->respondCreated($data, 'Team created successfully.');
        }

        return $this->fail('Failed to create team.');
    }

    public function show($id = null)
    {
        $team = $this->model->find($id);
        if (!$team) {
            return $this->failNotFound('Team not found.');
        }

        return $this->respond($team, 200);
    }
}
?>