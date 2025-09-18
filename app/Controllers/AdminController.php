<?php

namespace App\Controllers;

use Exception;
use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    // Move authentication check to initController
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        // Check authentication for all admin methods except those that should be public
        if (!session()->get('isLoggedIn')) {
            log_message('info', 'Unauthorized access attempt to admin area');
            
            // Store the intended URL for redirect after login
            session()->set('redirect_url', current_url());
            
            // Redirect with error message
            redirect()->to('/')->with('error', 'Silakan login terlebih dahulu')->send();
            exit();
        }
        
        log_message('info', 'Admin access granted for user: ' . session()->get('username'));
    }

    public function index()
    {
        $userData = [
            'user_id' => session()->get('user_id'),
            'username' => session()->get('username'),
            'email' => session()->get('email'),
            'login_time' => session()->get('login_time')
        ];

        try {
            $totalUsers = $this->userModel->countAll();
            $activeUsers = $this->userModel->where('is_active', 1)->countAllResults(false);
        } catch (Exception $e) {
            log_message('error', 'Database error in admin dashboard: ' . $e->getMessage());
            $totalUsers = 0;
            $activeUsers = 0;
        }

        $data = [
            'title' => 'Dashboard Admin',
            'user' => $userData,
            'stats' => [
                'total_users' => $totalUsers,
                'active_users' => $activeUsers,
                'inactive_users' => $totalUsers - $activeUsers
            ]
        ];

        return view('admin/dashboard', $data);
    }

    public function profile()
    {
        $userId = session()->get('user_id');
        
        try {
            $user = $this->userModel->find($userId);
        } catch (Exception $e) {
            log_message('error', 'Database error finding user: ' . $e->getMessage());
            return redirect()->to('/logout')->with('error', 'Terjadi kesalahan sistem');
        }

        if (!$user) {
            return redirect()->to('/logout')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'title' => 'Profile Sekolah',
            'user' => $user
        ];

        return view('admin/profile', $data);
    }

    // All your other methods remain the same...
    public function InputGuru()
    {
        $data = [
            "title" => "Input Data Guru"
        ];
        return view('admin/data-tabel/input-guru', $data);
    }

    public function DataSiswa()
    {
        $data = [
            "title" => "Data Siswa"
        ];
        return view('admin/data-tabel/data-siswa', $data);
    }

    public function InputSiswa()
    {
        $data = [
            "title" => "Input Data Siswa"
        ];
        return view('admin/data-tabel/input-siswa', $data);
    }

    public function DataKelas()
    {
        $data = [
            "title" => "Data Kelas"
        ];
        return view('admin/data-tabel/data-kelas', $data);
    }

    public function InputKelas()
    {
        $data = [
            "title" => "Input Data Kelas"
        ];
        return view('admin/data-tabel/input-kelas', $data);
    }

    public function DataKasSpp()
    {
        $data = [
            "title" => "Data Kas SPP"
        ];
        return view('admin/data-kas/data-kas-spp', $data);
    }

    public function InputKasSpp()
    {
        $data = [
            "title" => "Input Data Kas SPP"
        ];
        return view('admin/data-kas/input-data-kas-spp', $data);
    }

    public function DataKasSemester()
    {
        $data = [
            "title" => "Data Kas Semester"
        ];
        return view('admin/data-kas/data-kas-semester', $data);
    }

    public function InputKasSemester()
    {
        $data = [
            "title" => "Input Data Kas Semester"
        ];
        return view('admin/data-kas/input-data-kas-semester', $data);
    }

    public function DataKasGaji()
    {
        $data = [
            "title" => "Data Kas Gaji"
        ];
        return view('admin/data-kas/data-kas-gaji', $data);
    }

    public function InputKasGaji()
    {
        $data = [
            "title" => "Input Data Kas Gaji"
        ];
        return view('admin/data-kas/input-data-kas-gaji', $data);
    }

    public function KasSpp()
    {
        $data = [
            "title" => "Kas SPP"
        ];
        return view('admin/kas-masuk/kas-spp', $data);
    }

    public function KasSppDetail()
    {
        $data = [
            "title" => "Kas SPP Detail"
        ];
        return view('admin/kas-masuk/kas-spp-detail', $data);
    }

    public function KasSemester()
    {
        $data = [
            "title" => "Kas Semester"
        ];
        return view('admin/kas-masuk/kas-semester', $data);
    }

    public function KasSemesterDetail()
    {
        $data = [
            "title" => "Kas Semester Detail"
        ];
        return view('admin/kas-masuk/kas-semester-detail', $data);
    }

    public function KasPemasukan()
    {
        $data = [
            "title" => "Data Kas Pemasukan"
        ];
        return view('admin/kas-masuk/kas-pemasukan', $data);
    }

    public function InputKasPemasukan()
    {
        $data = [
            "title" => "Input Data Kas Pemasukan"
        ];
        return view('admin/kas-masuk/input-kas-pemasukan', $data);
    }

    public function KasGaji()
    {
        $data = [
            "title" => "Kas Gaji"
        ];
        return view('admin/kas-keluar/kas-gaji', $data);
    }

    public function KasGajiDetail()
    {
        $data = [
            "title" => "Kas Gaji Detail"
        ];
        return view('admin/kas-keluar/kas-gaji-detail', $data);
    }

    public function KasPengeluaran(): string
    {
        $data = [
            "title" => "Data Kas Pengeluaran"
        ];
        return view('admin/kas-keluar/kas-pengeluaran', $data);
    }

    public function InputKasPengeluaran()
    {
        $data = [
            "title" => "Input Data Kas Pengeluaran"
        ];
        return view('admin/kas-keluar/input-kas-pengeluaran', $data);
    }

    public function updateProfile()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        $userId = session()->get('user_id');

        $rules = [
            'username' => [
                'rules' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$userId}]",
                'errors' => [
                    'required' => 'Username harus diisi',
                    'min_length' => 'Username minimal 3 karakter',
                    'max_length' => 'Username maksimal 50 karakter',
                    'is_unique' => 'Username sudah digunakan'
                ]
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[users.email,id,{$userId}]",
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ]
        ];

        // Add password validation if password is provided
        if ($this->request->getPost('password')) {
            $rules['password'] = [
                'rules' => 'min_length[6]',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ];
            $rules['confirm_password'] = [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email')
        ];

        // Update password if provided
        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        try {
            if ($this->userModel->update($userId, $updateData)) {
                // Update session data
                session()->set([
                    'username' => $updateData['username'],
                    'email' => $updateData['email']
                ]);

                return redirect()->back()->with('success', 'Profile berhasil diupdate');
            } else {
                return redirect()->back()->with('error', 'Gagal mengupdate profile');
            }
        } catch (Exception $e) {
            log_message('error', 'Error updating profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate profile');
        }
    }
}