<?php

namespace App\Controllers;

use App\Models\CashReportModel;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\PointConfigurationModel;
use App\Models\PointModel;
use App\Models\VendorModel;
use Exception;

class FinanceController extends BaseController
{
    public function cash()
    {
        return view('admin/finance/cash');
    }

    public function sales()
    {
        return view('admin/finance/sales');
    }

    public function config()
    {
        return view('admin/point/configuration');
    }

    public function view($id)
    {
        $pointConfigModel = new PointConfigurationModel();

        $point = $pointConfigModel->where('id', $id)->first();
        return view('admin/point/edit_config', compact('point', 'id'));
    }

    public function update($id)
    {
        $session = session();
        $pointConfigModel = new PointConfigurationModel();
        try {
            $data = $this->request->getPost();

            $data_update = [
                'name' => $data['point_name'],
                'description' => $data['point_description'],
                'point' => $data['point_point'],
                'value' => $data['point_value'],
                'updated_at' => date('Y-m-d H:i:s.u')
            ];

            $pointConfigModel->update($id, $data_update);

            $session->setFlashdata('updateSuccessful', 'abc');
            return redirect()->to(base_url('admin/point/config'));
        } catch (Exception $e) {
            $session->setFlashdata('updateFailed', 'Update Failed, Please Try Again');
            return redirect()->to(base_url('admin/point/config/view') . '/' . $id);
        }
        return redirect()->to(base_url('admin/point/config/view') . '/' . $id);
    }

    public function searchSales()
    {
        $orderModel = new OrderModel();

        $month = $this->request->getGet("month");

        $order = $orderModel->monthSales($month)->getResultArray();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['created_at'] = date("d F Y", strtotime($order[$i]['created_at']));
            $order[$i]['total_price'] = AdminController::money_format_rupiah($order[$i]['total_price']);
        }

        return json_encode($order);
    }

    public function searchCash()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $cash = $cashModel->cashReport($month)->getResultArray();

        for ($i = 0; $i < count($cash); $i++) {
            $cash[$i]['created_at'] = date("d F Y", strtotime($cash[$i]['created_at']));
            $cash[$i]['balance'] = AdminController::money_format_rupiah($cash[$i]['balance']);
            if (isset($cash[$i]['debit'])) {
                $cash[$i]['debit'] = AdminController::money_format_rupiah($cash[$i]['debit']);
                $cash[$i]['credit'] = "-";
            } else {
                $cash[$i]['credit'] = AdminController::money_format_rupiah($cash[$i]['credit']);
                $cash[$i]['debit'] = "-";
            }
        }

        return json_encode($cash);
    }

    public function searchFirstBalance()
    {
        $cashModel = new CashReportModel();

        $month = $this->request->getGet("month");

        $cash = $cashModel->cashReport($month)->getResultArray();
        if (!isset($cash[0]['credit'])) {
            $first_balance = $cash[0]['balance'] - $cash[0]['debit'];
        } else {
            $first_balance = $cash[0]['balance'] + $cash[0]['credit'];
        }

        $first_balance = AdminController::money_format_rupiah($first_balance);

        $result['first_balance'] = $first_balance;

        return json_encode($result);
    }

    public function searchSalesTotal()
    {
        $orderModel = new OrderModel();

        $month = $this->request->getGet("month");

        $order = $orderModel->monthSales($month)->getResultArray();

        $total = 0;
        for ($i = 0; $i < count($order); $i++) {
            $total = $total + $order[$i]['total_price'];
        }
        $total = AdminController::money_format_rupiah($total);

        return json_encode($total);
    }

    public function searchConfig()
    {
        $pointConfigModel = new PointConfigurationModel();

        $point = $pointConfigModel->where('deleted_at', NULL)
            ->findAll();

        for ($i = 0; $i < count($point); $i++) {
            if (isset($point[$i]['updated_at'])) {

                $point[$i]['date'] = date("d F Y", strtotime($point[$i]['updated_at']));
                $point[$i]['time'] = date("H:i", strtotime($point[$i]['updated_at']));
            } else {
                $point[$i]['date'] = "No Update Yet";
            }
            $point[$i]['value'] = AdminController::money_format_rupiah($point[$i]['value']);
        }

        return json_encode($point);
    }

    public function activate($id)
    {
        $session = session();
        $vendorModel = new VendorModel();

        $data = [
            'is_active' => 1,
        ];

        $vendorModel->update($id, $data);

        $vendor = $vendorModel->where('id', $id)->first();

        $session->setFlashdata('activatevendor', '.');

        return view('admin/vendor/index', compact('vendor'));
    }

    public function deactivate($id)
    {
        $session = session();
        $vendorModel = new VendorModel();

        $data = [
            'is_active' => 0,
        ];
        $vendorModel->update($id, $data);

        $vendor = $vendorModel->where('id', $id)->first();

        $session->setFlashdata('deactivatevendor', '.');

        return view('admin/vendor/index', compact('vendor'));
    }

    public function delete($id)
    {
        $session = session();
        $vendorModel = new VendorModel();

        $data = [
            'is_active' => 0
        ];

        $vendorModel->update($id, $data);
        $vendor = $vendorModel->where('id', $id)->first();

        $vendorModel->where('id', $id)->delete();

        $session->setFlashdata('deleteVendor', '.');

        return view('admin/vendor/index', compact('vendor'));
    }
}
