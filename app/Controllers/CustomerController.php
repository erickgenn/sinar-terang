<?php

namespace App\Controllers;

use App\Models\ContactUsModel;
use App\Models\CustomerModel;
use App\Models\FaqModel;
use App\Models\OrderModel;
use App\Models\OutletModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class CustomerController extends BaseController
{
    public function index()
    {
        return view('customer/index');
    }

    public function about()
    {
        $productModel = new ProductModel();
        $outletModel = new OutletModel();
        $orderModel = new OrderModel();
        $faqModel = new FaqModel();

        $product = $productModel->findAll();
        $count_product = count($product);

        $outlet = $outletModel->findAll();
        $count_outlet = count($outlet);

        $order = $orderModel->findAll();
        $count_order = count($order);

        $faq = $faqModel->where('deleted_at', NULL)->findAll();

        return view('customer/about', compact('count_product', 'count_outlet', 'count_order', 'faq'));
    }

    public function outlet()
    {
        $outletModel = new OutletModel();
        $outlet = $outletModel->where('deleted_at', null)->findAll();
        return view('customer/outlet', compact('outlet'));
    }

    public function contact()
    {
        $contactModel = new ContactUsModel();

        $contact = $contactModel->first();
        return view('customer/contact', compact('contact'));
    }

    public function services()
    {
        return view('customer/services');
    }

    public function product()
    {
        $productModel = new ProductModel();
        $product = $productModel->where('deleted_at', null)->findAll();
        $loop = count($product) - 1;

        $col_num = [];
        $lastKey = 0;
        while (!isset($col_num[$loop])) {
            $num = rand(3, 6);
            if (isset($col_num[$lastKey]) && isset($col_num[$lastKey - 1])) {
                if ($num == 6) {
                    if ($col_num[$lastKey] == 6 || $col_num[$lastKey - 1] == 6) {
                        continue;
                    }
                }
            }

            if ($num == 3 || $num == 6) {
                array_push($col_num, $num);
            }

            $lastKey = key(array_slice($col_num, -1, 1, true));
        }
        for ($i = 0; $i < count($product); $i++) {
            $product[$i]['price'] = AdminController::money_format_rupiah($product[$i]['price']);
        }

        return view('customer/product', compact('col_num', 'product'));
    }

    public function search()
    {
        $customerModel = new \App\Models\CustomerModel();

        $customer = $customerModel->where('deleted_at', NULL)
            ->findAll();
        for ($i = 0; $i < count($customer); $i++) {
            $customer[$i]['created_at'] = date("d F Y", strtotime($customer[$i]['created_at']));
        }

        return json_encode($customer);
    }

    public function activate($id)
    {
        $session = session();
        $customerModel = new CustomerModel();
        $data = [
            'is_active' => 1,
        ];

        $customerModel->update($id, $data);

        $customer = $customerModel->where('id', $id)->first();

        $session->setFlashdata('activatecustomer', '.');

        return view('admin/customer/index', compact('customer'));
    }

    public function deactivate($id)
    {
        $session = session();
        $customerModel = new CustomerModel();
        $data = [
            'is_active' => 0,
        ];
        $customerModel->update($id, $data);

        $customer = $customerModel->where('id', $id)->first();

        $session->setFlashdata('deactivatecustomer', '.');

        return view('admin/customer/index', compact('customer'));
    }
}
