<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\\Models\\UserModel';
    protected $format = 'json';

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set(['user_id' => $user['id'], 'role' => $user['role']]);
            return $this->respond(['message' => 'Login successful.'], 200);
        }

        return $this->fail('Invalid login credentials.', 401);
    }

    public function register()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user',
        ];

        if ($this->model->save($data)) {
            return $this->respondCreated($data, 'Registration successful.');
        }

        return $this->fail('Failed to register user.');
    }

    public function logout()
    {
        session()->destroy();
        return $this->respond(['message' => 'Logout successful.'], 200);
    }
}
?>