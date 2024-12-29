<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use CodeIgniter\RESTful\ResourceController;

class SettingsController extends ResourceController
{
    protected $modelName = 'App\\Models\\SettingsModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll(), 200);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Settings updated successfully.');
        }

        return $this->fail('Failed to update settings.');
    }
}
?>