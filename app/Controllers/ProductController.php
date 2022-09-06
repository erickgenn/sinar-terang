<?php

namespace App\Controllers;

use App\Models\OutletModel;
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
        $outletModel = new OutletModel();
        $outlet = $outletModel->where('is_active', 1)->findAll();
        return view('admin/product/add_product', compact('outlet'));
    }

    public function store()
    {
        $session = session();
        $productModel = new ProductModel();
        try {
            $data = $this->request->getPost();
            // upload image
            $file = $this->request->getFile('product_picture');

            $target_dir = "uploads/product";
            $target_file = $target_dir . '/' . basename($file->getName());
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($file)) {
                $check = getimagesize($file->getTempName());
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }

            // Check file size
            if ($file->getSize() > 5000000) {
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $session->setFlashdata('ImageFailed', 'Please Try Another Image');
                // echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($file->getTempName(), $target_dir . '/' . $file->getName())) {
                    // upload to db
                    $data_insert = [
                        'name' => $data['product_name'],
                        'quantity' => $data['product_quantity'],
                        'price'    => $data['product_price'],
                        'picture'    => $file->getName(),
                        'description' => $data['product_description'],
                        'outlet_id' => $data['product_outlet_id']
                    ];

                    $productModel->insert($data_insert);

                    $session->setFlashdata('insertSuccessful', 'abc');
                    return redirect()->to(base_url('admin/product'));
                } else {
                    $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
                    return redirect()->to(base_url('admin/add_product'));
                }
            }
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_product'));
        }
        return redirect()->to(base_url('admin/add_product'));
    }

    public function search()
    {
        $productModel = new ProductModel();

        $product = $productModel
            ->findAll();

        $outletModel = new OutletModel();

        $arr_outlet_id = [];

        for ($i = 0; $i < count($product); $i++) {
            $product[$i]['created_at'] = date("d F Y", strtotime($product[$i]['created_at']));
            $product[$i]['price'] = AdminController::money_format_rupiah($product[$i]['price']);

            if (strpos($product[$i]['outlet_id'], ",") !== false) {
                $arr_outlet_id = explode(",", $product[$i]['outlet_id']);
                $outlet = $outletModel->whereIn('id', $arr_outlet_id)->findAll();
            } else {
                $outlet = $outletModel->where('id', $product[$i]['outlet_id'])->findAll();
            }

            for ($j = 0; $j < count($outlet); $j++) {
                $product[$i]['outlet_name'] = $outlet[$j]['name'];
            }
        }



        return json_encode($product);
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
