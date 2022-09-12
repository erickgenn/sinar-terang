<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;
use Exception;

class UserController extends BaseController
{
    public function index()
    {
        return view('admin/user/index');
    }

    public function add()
    {
        return view('admin/user/add_user');
    }

    public function search()
    {
        $userModel = new UserModel();

        $user = $userModel->where('deleted_at', NULL)
            ->findAll();
        for ($i = 0; $i < count($user); $i++) {
            $user[$i]['created_at'] = date("d F Y", strtotime($user[$i]['created_at']));
        }

        return json_encode($user);
    }

    public function store()
    {
        $session = session();
        $userModel = new UserModel();
        try {
            $data = $this->request->getPost();

            $data_insert = [
                'name' => $data['user_name'],
                'email' => $data['user_email'],
                'password' => md5($data['user_password']),
                'role' => $data['role'],
            ];

            $userModel->insert($data_insert);

            $session->setFlashdata('insertSuccessful', 'abc');
            return redirect()->to(base_url('admin/user'));
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('admin/user/add_user'));
        }
        return redirect()->to(base_url('admin/user/add_user'));
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
