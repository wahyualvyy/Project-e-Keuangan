<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "Login Admin"
        ];
        return view('admin/login/index', $data);
    }
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->verifyPassword($username, $password);

            if ($user) {
                session()->set([
                    'isLoggedIn' => true,
                    'id' => $user['id'],
                    'username' => $user['username'],
                ]);
                return redirect()->to('/admin')->with('success', 'Login successful');
            } else {
                return redirect()->back()->with('error', 'Username atau password salah');
            }
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
