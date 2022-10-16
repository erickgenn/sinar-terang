<?php

namespace App\Controllers;

use App\Models\BalanceModel;
use App\Models\CashReportModel;
use App\Models\CustomerModel;
use App\Models\DetailOrderModel;
use App\Models\OrderCancelRequestModel;
use App\Models\OrderModel;
use App\Models\OutletModel;
use App\Models\PointConfigurationModel;
use App\Models\PointModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Exception;

class OrderController extends BaseController
{
    private $salt, $iv, $key, $method;

    function __construct()
    {
        $this->salt = "59731B52B3EC58FA";
        $this->key = "05788993F8E4CE6A";
        $this->iv = "46060159617A8U7J";
        $this->method = "AES-128-CBC";
    }

    public function index()
    {
        return view('admin/order/index');
    }

    public function request()
    {
        return view('admin/order/cancel_request');
    }

    public function add()
    {
        $productModel = new ProductModel();
        $outletModel = new OutletModel();
        $product = $productModel->where('quantity !=', 0)->where('is_active', 1)->findAll();
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

    public function addMember()
    {
        $productModel = new ProductModel();
        $outletModel = new OutletModel();

        $data = $this->request->getPost();
        $customer_id = $data['cust_id'];

        $customerModel = new CustomerModel();
        $customer = $customerModel->where('id', $customer_id)->first();

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
        return view('admin/order/add_order', compact('product', 'customer_id', 'customer'));
    }

    public function addMembership($customer_id)
    {
        $productModel = new ProductModel();
        $outletModel = new OutletModel();

        $data = $this->request->getPost();

        $customerModel = new CustomerModel();
        $customer = $customerModel->where('id', $customer_id)->first();

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
        return view('admin/order/add_order', compact('product', 'customer_id', 'customer'));
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

    public function searchRequest()
    {
        $orderRequestModel = new OrderCancelRequestModel();
        $userModel = new UserModel();

        $request = $orderRequestModel->where('deleted_at', NULL)
            ->findAll();

        for ($i = 0; $i < count($request); $i++) {
            $user = $userModel->where('id', $request[$i]['request_by'])->first();
            $request[$i]['request_by'] = $user['name'];
            $request[$i]['created_at'] = date("d F Y", strtotime($request[$i]['created_at']));
        }

        return json_encode($request);
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



    public function store()
    {
        $session = session();
        $orderModel = new OrderModel();
        $detailOrderModel = new DetailOrderModel();
        $productModel = new ProductModel();
        $cashReportModel = new CashReportModel();
        $balanceModel = new BalanceModel();
        $pointModel = new PointModel();
        $customerModel = new CustomerModel();
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
                    if (isset($data['customer_id'])) {
                        $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
                        return redirect()->to(base_url('admin/add_order/member') . "/" . $data['customer_id']);
                    } else {
                        $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
                        return redirect()->to(base_url('admin/add_order'));
                    }
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

            if (isset($data['order_points'])) {
                $pointConfigModel = new PointConfigurationModel();
                $point = $pointConfigModel->where('id', '1')->first();
                $discount = (int) $data['order_points'] / $point['point'] * $point['value'];

                $total_price = $total_price - $discount;

                $data_insert = [
                    'total_price' => $total_price,
                    'discount' => $discount
                ];
            }

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

            $balance = $balanceModel->where('id', 1)->first();
            $balance_new = (int)$balance['balance'] + $total_price;
            $data_insert_cash = [
                'description' => "Order Number " . $orderModel->getInsertID(),
                'debit' => $total_price,
                'date' => date("Y-m-d"),
                'balance' => $balance_new,
                'type' => "order",
            ];

            $cashReportModel->insert($data_insert_cash);

            $data_update_balance = [
                'balance' => $balance_new,
            ];

            $balanceModel->update('1', $data_update_balance);

            if (isset($data['order_points'])) {
                $data_insert_point = [
                    'operation' => "-",
                    "point" => $data['order_points'],
                    'customer_id' => $data['customer_id']
                ];
                $pointModel->insert($data_insert_point);

                $cust = $customerModel->where('id', $data['customer_id'])->first();
                $data_update_point = [
                    'point' => (int) $cust['point'] - (int) $data['order_points'],
                ];

                $customerModel->update($data['customer_id'], $data_update_point);
            }

            $session->setFlashdata('insertSuccessful', 'abc');
            return redirect()->to(base_url('admin/order'));
        } catch (Exception $e) {
            if (isset($data['customer_id'])) {
                $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
                return redirect()->to(base_url('admin/add_order/member') . "/" . $data['customer_id']);
            } else {
                $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
                return redirect()->to(base_url('admin/add_order'));
            }
        }
        return redirect()->to(base_url('admin/add_order'));
    }

    public function requestCancel()
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
                'order_id' => $data['order_id'],
            ];

            $orderModel->update($data['order_id'], $data_update);

            $orderRequestModel->insert($data_insert);

            $session->setFlashdata('cancelSuccessful', 'abc');
            return redirect()->to(base_url('admin/order'));
        } catch (Exception $e) {
            $session->setFlashdata('cancelFailed', 'Insert Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_order'));
        }
        return redirect()->to(base_url('admin/order'));
    }

    public function acceptRequest($cancel_id, $order_id)
    {
        $session = session();
        $orderModel = new OrderModel();
        $balanceModel = new BalanceModel();
        $orderRequestModel = new OrderCancelRequestModel();
        $cashReportModel = new CashReportModel();

        $orderRequestModel->delete($cancel_id);
        $order = $orderModel->where('id', $order_id)->first();

        $balance = $balanceModel->where('id', 1)->first();
        $balance_new = (int)$balance['balance'] - $order['total_price'];
        $data_insert_cash = [
            'description' => "Cancelled Order Number " . $orderModel->getInsertID(),
            'credit' => $order['total_price'],
            'date' => date("Y-m-d"),
            'balance' => $balance_new,
            'type' => "order",
        ];

        $cashReportModel->insert($data_insert_cash);

        $data_update_balance = [
            'balance' => $balance_new,
        ];

        $balanceModel->update('1', $data_update_balance);

        $orderModel->delete($order_id);

        $session->setFlashdata('acceptRequest', '.');

        return view('admin/order/cancel_request', compact('order'));
    }

    public function declineRequest($cancel_id, $order_id)
    {
        $session = session();
        $orderModel = new OrderModel();
        $orderRequestModel = new OrderCancelRequestModel();

        $orderRequestModel->delete($cancel_id);

        $data_update = [
            'request_cancel' => 0,
        ];
        $orderModel->update($order_id, $data_update);

        $order = $orderModel->where('id', $order_id)->first();

        $session->setFlashdata('declineRequest', '.');
        return view('admin/order/cancel_request', compact('order'));
    }

    public function searchCust()
    {
        $custModel = new CustomerModel();


        if (!isset($_GET['search'])) {
            $customer = $custModel->where("is_active", 1)->findAll();
        } else {
            $field = "name";
            $customer = $custModel->where("is_active", 1)->like('LOWER(' . $field . ')', strtolower($_GET['search']))->findAll();
        }

        $list = array();
        for ($i = 0; $i < count($customer); $i++) {
            $list[$i]['id'] = $customer[$i]['id'];
            $list[$i]['text'] = $customer[$i]['name'];
        }

        return json_encode($list);
    }

    public function print($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->where('id', $id)->first();
        $encrypt_qr = OrderController::aes128Encrypt($id);

        // dd($encrypt_qr);
        $order['created_at'] = date("d F Y", strtotime($order['created_at']));
        $order['total_price'] = AdminController::money_format_rupiah($order['total_price']);
        return view("admin/order/print_invoice", compact('id', 'order', 'encrypt_qr'));
    }

    public function aes128Encrypt($order_id)
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);

        $plaintext = [
            "order_id" => $order_id,
        ];

        $plain = json_encode($plaintext, TRUE);

        $ciphertext_raw = openssl_encrypt($plain, $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv);

        $ciphertext = base64_encode($ciphertext_raw);

        $ciphertext = OrderController::ToBase64UrlString($ciphertext);

        return $ciphertext;
    }

    public function ToBase64UrlString($text)
    {
        $step_1 = str_replace("/", "_", $text);
        $step_2 = str_replace("+", "-", $step_1);
        return $step_2;
    }
}
