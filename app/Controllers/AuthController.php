<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;

class AuthController extends BaseController
{


    public function admin()
    {
        return view('auth/login_admin');
    }

    public function registerAdmin()
    {
        return view('auth/register_admin');
    }

    public function customer()
    {
        return view('auth/login_customer');
    }
    public function registerCustomer()
    {
        return view('auth/register_customer');
    }

    public function loginAdmin()
    {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->where('password', $password)->first();

        if (isset($user)) {
            // If login is successful
            $session_data = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'isLoggedIn' => TRUE,
                'role' => 'admin',
            ];
            $session->set($session_data);
            $session->setFlashdata('login_successful', $user['name']);

            return redirect()->to('admin/dashboard');
        } else {
            // If login is not successful
            $session->setFlashdata('login_failed', "failed");

            return redirect()->to('login/admin');
        }
        // return view('auth/login_admin');
    }

    public function loginCustomer()
    {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);

        $customerModel = new CustomerModel();
        $customer = $customerModel->where('email', $email)->where('password', $password)->first();

        if (isset($customer)) {
            // If login is successful
            $session_data = [
                'id' => $customer['id'],
                'name' => $customer['name'],
                'email' => $customer['email'],
                'isLoggedIn' => TRUE,
                'role' => 'admin',
            ];
            $session->set($session_data);
            $session->setFlashdata('login_successful', $customer['name']);

            // return redirect()->to('home');
        } else {
            // If login is not successful
            $session->setFlashdata('login_failed', "failed");

            return redirect()->to('login/customer');
        }
        // return view('auth/login_admin');
    }

    public function registerCustomerAuth()
    {
        $session = session();

        $data = $this->request->getPost();
        $name = $data['full_name'];
        $phone = $data['phone'];
        $email = $data['email'];
        $password = md5($data['password']);
        $confirm_password = md5($data['confirm_password']);
        if ($password != $confirm_password) {
            $session->setFlashdata('password_different', "failed");
            return redirect()->to('register/customer');
        }

        $customerModel = new CustomerModel();
        $search_email = $customerModel->where('email', $email)->first();

        if (isset($search_email)) {
            $session->setFlashdata('email_used', "failed");
            return redirect()->to('register/customer');
        }

        $data_insert = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password
        ];
        $customerModel->insert($data_insert);

        $session->setFlashdata('registration_successful', "success");
        return redirect()->to('login/customer');
    }

    public function logout()
    {
        session_unset();
    }
}
