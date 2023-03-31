<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Exception;

class ProductController extends BaseController
{
    public function index()
    {
        return view('admin/product/index');
    }

    public function add()
    {
        return view('admin/product/add_product');
    }

    public function view($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->where('id', $id)->first();


        return view('admin/product/edit_product', compact('product', 'id'));
    }

    public function update($id)
    {
        $session = session();
        $productModel = new ProductModel();
        try {

            $data = $this->request->getPost();
            $data_update = [
                'name' => $data['product_name'],
                'code' => $data['product_code'],
                'quantity' => $data['product_quantity'],
                'price'    => $data['price'],
                'price_low'    => $data['price_low'],
                'description' => $data['product_description'],
                'updated_at' => date(("Y-m-d H:i:s.000"), strtotime("Now")),
            ];

            $productModel->update($id, $data_update);

            $session->setFlashdata('updateSuccessful', 'abc');
            return redirect()->to(base_url('admin/product'));
        } catch (Exception $e) {
            $session->setFlashdata('updateFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('admin/product/view') . '/' . $id);
        }
    }

    public function store()
    {
        $session = session();
        $productModel = new ProductModel();
        try {
            $data = $this->request->getPost();

            $data_insert = [
                'name' => $data['product_name'],
                'code' => $data['product_code'],
                'quantity' => $data['product_quantity'],
                'price'    => $data['price'],
                'price_low'    => $data['price_low'],
                'description' => $data['product_description'],
            ];

            $productModel->insert($data_insert);

            $session->setFlashdata('insertSuccessful', 'abc');
            return redirect()->to(base_url('admin/product'));
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_product'));
        }
        return redirect()->to(base_url('admin/add_product'));
    }

    public function search()
    {
        $productModel = new ProductModel();

        $product = $productModel->where('deleted_at', NULL)
            ->findAll();

        for ($i = 0; $i < count($product); $i++) {
            $product[$i]['created_at'] = date("d F Y", strtotime($product[$i]['created_at']));
            $product[$i]['price'] = AdminController::money_format_rupiah($product[$i]['price']);
            $product[$i]['price_low'] = AdminController::money_format_rupiah($product[$i]['price_low']);
        }
        return json_encode($product);
    }

    public function delete($id)
    {
        $session = session();
        $productModel = new ProductModel();

        $data = [
            'is_active' => 0
        ];

        $productModel->update($id, $data);
        $product = $productModel->where('id', $id)->first();

        $productModel->where('id', $id)->delete();

        $session->setFlashdata('deleteProduct', '.');

        return view('admin/product/index', compact('product'));
    }

    public function activate($id)
    {
        $session = session();
        $productModel = new ProductModel();
        $data = [
            'is_active' => 1,
        ];

        $productModel->update($id, $data);

        $product = $productModel->where('id', $id)->first();

        $session->setFlashdata('activateProduct', '.');

        return view('admin/product/index', compact('product'));
    }

    public function deactivate($id)
    {
        $session = session();
        $productModel = new ProductModel();
        $data = [
            'is_active' => 0,
        ];
        $productModel->update($id, $data);

        $product = $productModel->where('id', $id)->first();

        $session->setFlashdata('deactivateProduct', '.');

        return view('admin/product/index', compact('product'));
    }
}
