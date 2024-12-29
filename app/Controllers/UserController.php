<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\\Models\\UserModel';
    protected $format = 'json';


    public function createUser($data)
    {
        return $this->model->insert($data);
    }

    // Show login view
    public function showLogin()
    {
        return view('auth/login'); // Assumes a view file exists at app/Views/auth/login.php
    }

    // Show register view
    public function showRegister()
    {
        return view('auth/register'); // Assumes a view file exists at app/Views/auth/register.php
    }

    // Handle registration
    public function register()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user',
        ];

        if ($this->createUser($data)) {
            return $this->respondCreated($data, 'Registration successful.');
        }

        return $this->fail('Failed to register user.');
    }


    // Store a new user in the database
    

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

    public function logout()
    {
        session()->destroy();
        return $this->respond(['message' => 'Logout successful.'], 200);
    }
}
?>
