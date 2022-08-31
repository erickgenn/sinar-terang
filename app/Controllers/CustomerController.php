<?php

namespace App\Controllers;

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

    public function work()
    {
        return view('customer/work');
    }

    public function search()
    {
        $customerModel = new \App\Models\CustomerModel();

        $customer = $customerModel
            ->where('is_active', 1)
            ->findAll();
        for ($i = 0; $i < count($customer); $i++) {
            $customer[$i]['created_at'] = date("d F Y", strtotime($customer[$i]['created_at']));
        }

        return json_encode($customer);
    }
}
