<?php

namespace App\Controllers;

use App\Models\JurusanModel;
use App\Models\SemesterModel;
use App\Controllers\BaseController;
use App\Controllers\JurusanController;
use CodeIgniter\HTTP\ResponseInterface;

class SemesterController extends BaseController
{
    protected $semesterModel;
    protected $jurusanModel;
    public function __construct()
    {
        $this->semesterModel = new SemesterModel();
        $this->jurusanModel = new JurusanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Semester',
            'semester' => $this->semesterModel->getWithRealtion(),
        ];

        return view('admin/data-kas/data-kas-semester', $data);
    }

    public function inputSemester()
    {
        $data = [
            'title' => 'Input Data Semester',
            'jurusan' => $this->jurusanModel->findAll()
        ];

        return view('admin/Inputs/input-data-kas-semester', $data);
    }
}
