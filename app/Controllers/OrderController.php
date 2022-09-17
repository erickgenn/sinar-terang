<?php

namespace App\Controllers;

use App\Models\DetailOrderModel;
use App\Models\OrderCancelRequestModel;
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
        $product = $productModel->where('quantity !=', 0)->findAll();
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
            $order[$i]['total_price'] = AdminController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['created_at'] = date("d F Y", strtotime($order[$i]['created_at']));
        }

        return json_encode($order);
    }

    public function searchDetail($id)
    {
        $detailOrderModel = new DetailOrderModel();
        $productModel = new ProductModel();
        $detail = $detailOrderModel->where('order_id', $id)->findAll();

        for ($i = 0; $i < count($detail); $i++) {
            $product = $productModel->where('id', $detail[$i]['product_id'])->first();
            $detail[$i]['product_name'] = $product['name'];
            $detail[$i]['amount'] = (int) $detail[$i]['product_price'] * (int) $detail[$i]['quantity'];
            $detail[$i]['amount'] = AdminController::money_format_rupiah($detail[$i]['amount']);
            $detail[$i]['product_price'] = AdminController::money_format_rupiah($detail[$i]['product_price']);
        }

        return json_encode($detail);
    }

    public function print($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->where('id', $id)->first();
        $order['created_at'] = date("d F Y", strtotime($order['created_at']));
        $order['total_price'] = AdminController::money_format_rupiah($order['total_price']);
        return view("admin/order/print_invoice", compact('id', 'order'));
    }

    public function store()
    {
        $session = session();
        $orderModel = new OrderModel();
        $detailOrderModel = new DetailOrderModel();
        $productModel = new ProductModel();
        try {
            $data = $this->request->getPost();

            $product_id = explode(",", $data['list_id']);

            $total_price = 0;
            for ($i = 0; $i < count($product_id); $i++) {
                $product = $productModel->where('id', $product_id[$i])->first();
                $price = $product['price'];
                $qty = $data['product_qty'][$i];
                $updated_qty = (int) $product['quantity'] - $qty;
                if ($updated_qty < 0) {
                    $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
                    return redirect()->to(base_url('admin/add_order'));
                }
                $total_temp = $price * $qty;
                $total_price = $total_price + $total_temp;
                $data_update = [
                    'quantity' => $updated_qty,
                ];
                $productModel->update($product_id[$i], $data_update);
            }

            $data_insert = [
                'total_price' => $total_price,
            ];

            $orderModel->insert($data_insert);

            for ($i = 0; $i < count($product_id); $i++) {
                $product = $productModel->where('id', $product_id[$i])->first();
                $data_insert_detail = [
                    'product_id' => $product_id[$i],
                    'product_price' => $product['price'],
                    'quantity' => $data['product_qty'][$i],
                    'order_id' => $orderModel->getInsertID(),
                ];
                $detailOrderModel->insert($data_insert_detail);
            }

            $session->setFlashdata('insertSuccessful', 'abc');
            return redirect()->to(base_url('admin/order'));
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_order'));
        }
        return redirect()->to(base_url('admin/add_order'));
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

    public function requestCancel($id)
    {
        $session = session();
        $orderModel = new OrderModel();
        $orderRequestModel = new OrderCancelRequestModel();
        try {
            $data = $this->request->getPost();

            $data_update = [
                'request_cancel' => 1,
            ];

            $data_insert = [
                'reason' => $data['cancel_reason'],
                'request_by' => $_SESSION['id'],
            ];

            $orderModel->update($id, $data_update);

            $orderRequestModel->insert($data_insert);

            $session->setFlashdata('cancelSuccessful', 'abc');
            return redirect()->to(base_url('admin/order'));
        } catch (Exception $e) {
            $session->setFlashdata('cancelFailed', 'Insert Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_order'));
        }
        return redirect()->to(base_url('admin/add_order'));
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
