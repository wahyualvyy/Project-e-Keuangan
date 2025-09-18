<?php

namespace App\Controllers;

use Exception;
use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // If user is already logged in, redirect to admin
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin');
        }

        $data = [
            "title" => "Login Admin"
        ];
        return view('admin/login/index', $data);
    }

    public function login()
    {
        // Debug: Log the request method
        log_message('info', 'Login attempt - Method: ' . $this->request->getMethod());
        
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/');
        }

        // Validation rules
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Username harus diisi'
                ]
            ],
            'password' => [
                'label' => 'Password', 
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            log_message('error', 'Validation failed: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        // Debug logging
        log_message('info', 'Login attempt for username: ' . $username);
        
        // Check if user exists first
        $user = $this->userModel->getUserByIdentity($username);
        
        if (!$user) {
            log_message('info', 'User not found: ' . $username);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah. Silakan coba lagi.');
        }

        log_message('info', 'User found: ' . $user['username']);
        
        // Verify password
        if (!password_verify($password, $user['password'])) {
            log_message('info', 'Password verification failed for user: ' . $username);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah. Silakan coba lagi.');
        }

        log_message('info', 'Password verified successfully for user: ' . $username);

        // Remove password from user data
        unset($user['password']);

        // Set session data
        $sessionData = [
            'isLoggedIn' => true,
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'login_time' => time()
        ];

        // Start/regenerate session for security
        session()->regenerate();
        session()->set($sessionData);
        
        log_message('info', 'Session data set for user: ' . $username);

        // Handle remember me functionality
        if ($remember) {
            try {
                // Set cookie for 30 days
                $this->response->setCookie(
                    'remember_token',
                    password_hash($user['id'] . $user['username'] . time(), PASSWORD_DEFAULT),
                    time() + (30 * 24 * 60 * 60), // 30 days
                    '/',
                    '',
                    false, // secure (set to true in production with HTTPS)
                    true   // HttpOnly
                );
                log_message('info', 'Remember me cookie set for user: ' . $username);
            } catch (Exception $e) {
                log_message('error', 'Failed to set remember me cookie: ' . $e->getMessage());
            }
        }

        log_message('info', 'Redirecting to admin dashboard for user: ' . $username);
        
        // Use absolute URL to ensure proper redirect
        return redirect()->to(base_url('/admin'))
            ->with('success', 'Login berhasil! Selamat datang ' . $user['username']);
    }

    public function logout()
    {
        // Log the logout attempt
        log_message('info', 'User logout: ' . (session()->get('username') ?? 'unknown'));
        
        // Remove remember me cookie
        if ($this->request->getCookie('remember_token')) {
            $this->response->deleteCookie('remember_token');
        }

        // Destroy session
        session()->destroy();

        return redirect()->to('/')->with('success', 'Anda berhasil logout');
    }

    // Method to check remember me cookie on app start
    public function checkRememberMe()
    {
        if (!session()->get('isLoggedIn') && $this->request->getCookie('remember_token')) {
            // You can implement auto-login logic here if needed
            // For security reasons, you might want to validate the token against database
        }
    }
}