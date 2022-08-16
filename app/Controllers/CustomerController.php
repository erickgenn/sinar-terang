<?php

namespace App\Controllers;

use App\Models\UserModel;

class CustomerController extends BaseController
{
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
