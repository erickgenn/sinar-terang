<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OutletModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Exception;

class OrderController extends BaseController
{
    public function index()
    {
        return view('admin/order/index');
    }

    public function add()
    {
        $productModel = new ProductModel();
        $outletModel = new OutletModel();
        $product = $productModel->findAll();
        for ($i = 0; $i < count($product); $i++) {
            $product[$i]['price'] = AdminController::money_format_rupiah($product[$i]['price']);

            if (strpos($product[$i]['outlet_id'], ",") != false) {
                $arr_outlet_id = explode(",", $product[$i]['outlet_id']);
                $outlet = $outletModel->whereIn('id', $arr_outlet_id)->findAll();
            } else {
                $outlet = $outletModel->where('id', $product[$i]['outlet_id'])->findAll();
            }

            $outlet_name = null;

            for ($j = 0; $j < count($outlet); $j++) {
                if (!isset($outlet_name)) {
                    $outlet_name = $outlet[$j]['name'];
                } else {
                    $outlet_name = $outlet_name . ", " . $outlet[$j]['name'];
                }
            }
            $product[$i]['outlet_name'] = $outlet_name;
        }
        return view('admin/order/add_order', compact('product'));
    }

    public function view($id)
    {
        $userModel = new UserModel();
        $user = $userModel->where('id', $id)->first();
        return view('admin/user/edit_user', compact('user', 'id'));
    }

    public function search()
    {
        $orderModel = new OrderModel();

        $order = $orderModel->where('deleted_at', NULL)
            ->findAll();
        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['created_at'] = date("d F Y", strtotime($order[$i]['created_at']));
        }

        return json_encode($order);
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
                'role' => $data['user_role'],
            ];

            $user = $userModel->where('email', $data['user_email'])->first();
            if (isset($user)) {
                $session->setFlashdata('emailFound', 'Upload Failed, Please Try Again');
                return redirect()->to(base_url('admin/add_user'));
            }

            $userModel->insert($data_insert);
            $user = $userModel->findAll();
            $count = count($user);
            $session->setFlashdata('insertSuccessful', 'abc');
            return view('admin/user/index', compact('count'));
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_user'));
        }
        return redirect()->to(base_url('admin/add_user'));
    }

    public function update($id)
    {
        $session = session();
        $userModel = new UserModel();
        try {
            $data = $this->request->getPost();

            $data_update = [
                'name' => $data['user_name'],
                'role' => $data['user_role'],
            ];

            $userModel->update($id, $data_update);

            $user = $userModel->findAll();
            $count = count($user);

            $session->setFlashdata('updateSuccessful', 'abc');
            return view('admin/user/index', compact('count'));
        } catch (Exception $e) {
            $session->setFlashdata('updateFailed', 'Update Failed, Please Try Again');
            return redirect()->to(base_url('admin/user/view') . '/' . $id);
        }
        return redirect()->to(base_url('admin/user/view') . '/' . $id);
    }

    public function delete($id)
    {
        $session = session();
        $userModel = new UserModel();

        $data = [
            'is_active' => 0
        ];

        $userModel->update($id, $data);

        $userModel->where('id', $id)->delete();

        $user = $userModel->findAll();
        $count = count($user);

        $session->setFlashdata('deleteOutlet', '.');

        return view('admin/user/index', compact('count'));
    }

    public function activate($id)
    {
        $session = session();
        $userModel = new UserModel();
        $data = [
            'is_active' => 1,
        ];

        $userModel->update($id, $data);

        $user = $userModel->where('id', $id)->first();
        $user_all = $userModel->findAll();
        $count = count($user_all);

        $session->setFlashdata('activateuser', '.');

        return view('admin/user/index', compact('user', 'count'));
    }

    public function deactivate($id)
    {
        $session = session();
        $userModel = new UserModel();
        $data = [
            'is_active' => 0,
        ];
        $userModel->update($id, $data);

        $user = $userModel->where('id', $id)->first();
        $user_all = $userModel->findAll();
        $count = count($user_all);
        $session->setFlashdata('deactivateuser', '.');

        return view('admin/user/index', compact('user', 'count'));
    }
}
