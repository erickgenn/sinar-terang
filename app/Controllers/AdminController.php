<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        // Get low quantity product
        $low_product = $productModel->where('quantity <=', '5')->findAll();

        return view('admin/dashboard', compact('low_product'));
    }

    // Money format
    public static function money_format_rupiah($num)
    {
        $result = "Rp " . number_format($num, 2, ',', '.');
        return $result;
    }
}
