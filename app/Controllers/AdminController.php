<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "Dasboard Admin"
        ];
        return view( 'layout/template', $data);
    }
}
