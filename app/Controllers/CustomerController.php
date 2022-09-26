<?php

namespace App\Controllers;

use App\Models\ContactUsModel;
use App\Models\CustomerModel;
use App\Models\FaqModel;
use App\Models\OrderModel;
use App\Models\OutletModel;
use App\Models\PointConfigurationModel;
use App\Models\PointModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class CustomerController extends BaseController
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

    public function point()
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->where('id', $_SESSION['id'])->first();

        $pointModel = new PointModel();
        $point = $pointModel->where('customer_id', $_SESSION['id'])->orderBy('created_at', 'DESC')->findAll(5, 0);
        for ($i = 0; $i < count($point); $i++) {
            $point[$i]['created_at'] = date("d F Y", strtotime($point[$i]['created_at']));
        }
        return view('customer/point', compact('customer', 'point'));
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

    public function claimQR($ciphertext)
    {
        return view('auth/login_qr', compact('ciphertext'));
    }

    public function claimPoint()
    {
        $session = session();
        session_unset();
        $customerModel = new CustomerModel();
        $orderModel = new OrderModel();
        $pointConfigModel = new PointConfigurationModel();
        $pointModel = new PointModel();
        $data = $this->request->getPost();

        $email = $data['email'];
        $password = md5($data['password']);
        $ciphertext = $data['ciphertext'];

        $customer = $customerModel->where('email', $email)->where('password', $password)->first();

        if (isset($customer)) {
            $session_data = [
                'id' => $customer['id'],
                'name' => $customer['name'],
                'email' => $customer['email'],
                'isLoggedIn' => TRUE,
                'role' => 'customer',
            ];

            $decrypt = CustomerController::aes128Decrypt($ciphertext);
            $order_id = $decrypt['order_id'];

            $order = $orderModel->where('id', $order_id)->first();

            if ($order['is_claimed'] == 1) {
                $session->setFlashdata('qr_claimed', "failed");
                return redirect()->to('/');
            } else {
                $qr_point = $pointConfigModel->where('id', 2)->first();

                $data_update_customer = [
                    'point' => (int) $customer['point'] + $qr_point['point'],
                ];

                $customerModel->update($customer['id'], $data_update_customer);

                $data_insert_point = [
                    'operation' => "+",
                    'point' => $qr_point['point'],
                    'customer_id' => $customer['id']
                ];

                $pointModel->insert($data_insert_point);

                $data_update_order = [
                    'customer_id' => $customer['id'],
                    'is_claimed' => 1
                ];

                $orderModel->update($order_id, $data_update_order);

                $session->setFlashdata('claim_success', "success");
                return redirect()->to('/point');
            }
        } else {
            $session->setFlashdata('login_failed', "failed");
            return view('auth/login_qr', compact('ciphertext'));
        }
    }

    public function aes128Decrypt($ciphertext_raw)
    {

        $ciphertext = base64_decode($ciphertext_raw);

        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_decrypt($ciphertext, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $this->iv);

        $data_decrypt = json_decode($ciphertext_raw, TRUE);

        return $data_decrypt;
    }
}
