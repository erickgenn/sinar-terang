<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index()
    {
        return view('admin/product/index');
    }

    public function search()
    {
        $productModel = new ProductModel();

        $product = $productModel
            ->where('is_active', 1)
            ->findAll();
        for ($i = 0; $i < count($product); $i++) {
            $product[$i]['created_at'] = date("d F Y", strtotime($product[$i]['created_at']));
        }

        return json_encode($product);
    }
}
