<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\PointConfigurationModel;
use App\Models\PointModel;
use App\Models\VendorModel;
use Exception;

class PointController extends BaseController
{
    public function index()
    {
        $pointModel = new PointModel();
        $pointGiven = $pointModel->where('deleted_at', NULL)->where('operation', '+')
            ->findAll();

        $total_point_given = 0;
        for ($i = 0; $i < count($pointGiven); $i++) {
            $total_point_given = $total_point_given + $pointGiven[$i]['point'];
        }

        $pointUsed = $pointModel->where('deleted_at', NULL)->where('operation', '-')
            ->findAll();

        $total_point_used = 0;
        for ($i = 0; $i < count($pointUsed); $i++) {
            $total_point_used = $total_point_used + $pointUsed[$i]['point'];
        }

        return view('admin/point/index', compact('total_point_given', 'total_point_used'));
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
                'updated_at' => date('Y-m-d H:i:s.u'),
                'user_id' => $_SESSION['id'],
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

    public function search()
    {
        $pointModel = new PointModel();
        $customerModel = new CustomerModel();

        $point = $pointModel->where('deleted_at', NULL)->where('point !=', '0')->orderBy('created_at', 'ASC')
            ->findAll();

        for ($i = 0; $i < count($point); $i++) {
            $customer = $customerModel->where('id', $point[$i]['customer_id'])->first();

            $point[$i]['date'] = date("d F Y", strtotime($point[$i]['created_at']));
            $point[$i]['time'] = date("H:i", strtotime($point[$i]['created_at']));
            $point[$i]['customer_name'] = $customer['name'];
        }

        return json_encode($point);
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
}
