<?php

namespace App\Controllers;

use App\Models\VendorModel;
use Exception;

class VendorController extends BaseController
{
    public function index()
    {
        return view('admin/vendor/index');
    }

    public function add()
    {
        return view('admin/vendor/add_vendor');
    }

    public function view($id)
    {
        $vendorModel = new VendorModel();
        $vendor = $vendorModel->where('id', $id)->first();
        return view('admin/vendor/edit_vendor', compact('vendor', 'id'));
    }

    public function store()
    {
        $session = session();
        $vendorModel = new VendorModel();
        try {
            $data = $this->request->getPost();

            $data_insert = [
                'name' => $data['vendor_name'],
                'phone' => $data['vendor_phone'],
                'contact_person' => $data['vendor_contact_person'],
            ];

            $vendorModel->insert($data_insert);

            $session->setFlashdata('insertSuccessful', 'abc');
            return redirect()->to(base_url('admin/vendor'));
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Insert Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_vendor'));
        }
        return redirect()->to(base_url('admin/add_vendor'));
    }

    public function update($id)
    {
        $session = session();
        $vendorModel = new VendorModel();
        try {
            $data = $this->request->getPost();

            $data_update = [
                'name' => $data['vendor_name'],
                'phone' => $data['vendor_phone'],
                'contact_person' => $data['vendor_contact_person'],
            ];

            $vendorModel->update($id, $data_update);

            $session->setFlashdata('updateSuccessful', 'abc');
            return redirect()->to(base_url('admin/vendor'));
        } catch (Exception $e) {
            $session->setFlashdata('updateFailed', 'Update Failed, Please Try Again');
            return redirect()->to(base_url('admin/vendor/view') . '/' . $id);
        }
        return redirect()->to(base_url('admin/vendor/view') . '/' . $id);
    }

    public function search()
    {
        $vendorModel = new VendorModel();

        $vendor = $vendorModel->where('deleted_at', NULL)
            ->findAll();

        return json_encode($vendor);
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
