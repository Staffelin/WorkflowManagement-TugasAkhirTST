<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login')->with('error', 'Please log in to access the dashboard.');
        }

        // Load dashboard view
        return view('dashboard');
    }
}
