<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $customerModel = new CustomerModel();
        $productModel = new ProductModel();
        $total = $orderModel->where('deleted_at', NULL)->findAll();
        $total_order = count($total);

        $request = $orderModel->where('request_cancel', '1')->findAll();
        $total_request = count($request);

        $customer = $customerModel->where('is_active', '1')->findAll();
        $total_customer = count($customer);

        $month = date("Y-m");
        $order = $orderModel->monthSales($month)->getResultArray();

        $total_sales = 0;
        for ($i = 0; $i < count($order); $i++) {
            $total_sales = $total_sales + $order[$i]['total_price'];
        }
        $gross_sales = 30 / 100 * $total_sales;
        $gross_sales = AdminController::money_format_rupiah($gross_sales);

        $date_monday = date("Y-m-d", strtotime("Monday This Week"));
        $date_tuesday = date("Y-m-d", strtotime("Tuesday This Week"));
        $date_wednesday = date("Y-m-d", strtotime("Wednesday This Week"));
        $date_thursday = date("Y-m-d", strtotime("Thurday This Week"));
        $date_friday = date("Y-m-d", strtotime("Friday This Week"));
        $date_saturday = date("Y-m-d", strtotime("Saturday This Week"));
        $date_sunday = date("Y-m-d", strtotime("Sunday This Week"));

        // Count new customer's registration
        $monday = $customerModel->countRegistrationDate($date_monday)->getResultArray();
        $tuesday = $customerModel->countRegistrationDate($date_tuesday)->getResultArray();
        $wednesday = $customerModel->countRegistrationDate($date_wednesday)->getResultArray();
        $thursday = $customerModel->countRegistrationDate($date_thursday)->getResultArray();
        $friday = $customerModel->countRegistrationDate($date_friday)->getResultArray();
        $saturday = $customerModel->countRegistrationDate($date_saturday)->getResultArray();
        $sunday = $customerModel->countRegistrationDate($date_sunday)->getResultArray();

        $count_customer = [count($monday), count($tuesday), count($wednesday), count($thursday), count($friday), count($saturday), count($sunday)];

        // Get low quantity product
        $low_product = $productModel->where('quantity <=', '5')->findAll();

        return view('admin/dashboard', compact('total_order', 'total_request', 'total_customer', 'gross_sales', 'count_customer', 'low_product'));
    }

    public function customer()
    {
        return view('admin/customer/index');
    }

    // Money format
    public static function money_format_rupiah($num)
    {
        $result = "Rp " . number_format($num, 2, ',', '.');
        return $result;
    }
}
