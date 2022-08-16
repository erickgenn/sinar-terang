<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function customer()
    {
        return view('admin/customer');
    }
}
