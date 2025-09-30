<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SppController extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "Data Kas SPP"
        ];
        return view('admin/data-kas/data-kas-spp', $data);
    }
    public function Input()
    {
        $data = [
            "title" => "Input Data Kas SPP"
        ];
        return view('admin/data-kas/input-data-kas-spp', $data);
    }
}
