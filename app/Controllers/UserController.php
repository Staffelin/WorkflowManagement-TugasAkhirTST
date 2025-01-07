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
        // Log session data for debugging
        log_message('info', 'Session Data: ' . json_encode(session()->get()));
    
        if (session()->get('user_id')) {
            // Redirect to dashboard if already logged in
            return redirect()->to('/dashboard');
        }
    
        return view('auth/login');
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
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user',
        ];
    
        if ($this->createUser($data)) {
            // Set user session (optional)
            $user = $this->model->where('email', $data['email'])->first();
            session()->set(['user_id' => $user['id'], 'role' => $user['role']]);
    
            // Redirect to dashboard
            return redirect()->to('/dashboard')->with('message', 'Registration successful.');
        }
    
        // Return error if registration fails
        return redirect()->back()->with('error', 'Failed to register user.');
    }

    public function profile()
    {
        // Check if the user is logged in
        if (!session()->get('user_id')) {
            // Redirect to login page if not authenticated
            return redirect()->to('/auth/login')->with('error', 'You must be logged in to access the profile page.');
        }
    
        // Get the logged-in user ID from the session
        $userId = session()->get('user_id');
    
        // Fetch the user's data from the database
        $user = $this->model->find($userId);
    
        if (!$user) {
            return redirect()->to('/auth/login')->with('error', 'User data not found.');
        }
    
        // Return the profile view with the user data
        return view('profiles', ['user' => $user]);
    }
        

    public function updateProfile()
    {
        $userId = session()->get('user_id');
        $user = $this->model->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'You must be logged in to update the profile.');
        }

        $rules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email,id,{id}]', // Ensures email is unique except for the current user
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        if ($this->model->update($userId, $data)) {
            return redirect()->to('/profile')->with('message', 'Profile updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update profile.');
    } 
    // Store a new user in the database
    

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        $user = $this->model->where('email', $email)->first();
    
        if ($user && password_verify($password, $user['password'])) {
            // Set user session
            session()->set(['user_id' => $user['id'], 'role' => $user['role']]);
            
            // Redirect to dashboard
            return redirect()->to('/dashboard');
        }
    
        // Return error if login fails
        return redirect()->back()->with('error', 'Invalid login credentials.');
    }
    

    public function logout()
    {
        session()->destroy();
        return $this->respond(['message' => 'Logout successful.'], 200);
    }
}
?>
