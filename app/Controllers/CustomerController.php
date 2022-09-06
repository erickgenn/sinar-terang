<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;

class CustomerController extends BaseController
{
    public function index()
    {
        return view('customer/index');
    }

    public function about()
    {
        return view('customer/about');
    }

    public function blog()
    {
        return view('customer/blog');
    }

    public function contact()
    {
        return view('customer/contact');
    }

    public function services()
    {
        return view('customer/services');
    }

    public function product()
    {
        return view('customer/product');
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
