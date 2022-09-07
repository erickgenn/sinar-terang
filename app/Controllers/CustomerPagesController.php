<?php

namespace App\Controllers;

use App\Models\ContactUsModel;
use App\Models\CustomerModel;
use App\Models\UserModel;
use Exception;

class CustomerPagesController extends BaseController
{
    public function contactUs()
    {
        return view('admin/customer_pages/contact_us');
    }

    public function contactUsSearch()
    {
        $contactUsModel = new ContactUsModel();

        $contactUs = $contactUsModel->where('deleted_at', NULL)
            ->findAll();

        return json_encode($contactUs);
    }

    public function view($id)
    {
        $contactUsModel = new ContactUsModel();

        $contactUs = $contactUsModel->where('id', $id)->first();

        return view('admin/customer_pages/edit_contact_us', compact('contactUs', 'id'));
    }

    public function update($id)
    {
        $session = session();
        $contactUsModel = new ContactUsModel();
        try {
            $data = $this->request->getPost();
            $data_update = [
                'phone' => $data['contact_us_phone'],
                'email' => $data['contact_us_email'],
            ];

            $contactUsModel->update($id, $data_update);

            $session->setFlashdata('updateSuccessful', 'abc');
            return redirect()->to(base_url('admin/customer_pages/contact_us'));
        } catch (Exception $e) {
            $session->setFlashdata('updateFailed', 'Update Failed, Please Try Again');
            return redirect()->to(base_url('admin/customer_pages/contact_us/view') . '/' . $id);
        }
        return redirect()->to(base_url('admin/customer_pages/contact_us/view') . '/' . $id);
    }
}
