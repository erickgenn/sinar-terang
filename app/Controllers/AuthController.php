<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function admin()
    {
        return view('auth/login_admin');
    }

    public function adminAuth()
    {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);
        dd($email, $password);
        die();

        // return view('auth/login_admin');
    }
}
