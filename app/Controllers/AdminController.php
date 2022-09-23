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
        return view('admin/customer/index');
    }

    public static function money_format_rupiah($num)
    {
        $result = "Rp " . number_format($num, 2, ',', '.');
        return $result;
    }
}
