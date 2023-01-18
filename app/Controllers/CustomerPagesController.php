<?php

namespace App\Controllers;

use App\Models\ContactUsModel;
use App\Models\CustomerModel;
use App\Models\FaqModel;
use App\Models\UserModel;
use Exception;

class CustomerPagesController extends BaseController
{
    public function contactUs()
    {
        return view('admin/customer_pages/contact_us');
    }

    public function faq()
    {
        $faqModel = new FaqModel();
        $faq = $faqModel->where('deleted_at', NULL)
            ->findAll();
        $count_faq = count($faq);
        return view('admin/customer_pages/faq', compact('count_faq'));
    }

    public function faqAdd()
    {
        return view('admin/customer_pages/add_faq');
    }

    public function contactUsSearch()
    {
        $contactUsModel = new ContactUsModel();

        $contactUs = $contactUsModel->where('deleted_at', NULL)
            ->findAll();

        return json_encode($contactUs);
    }

    public function faqSearch()
    {
        $faqModel = new FaqModel();

        $faq = $faqModel->where('deleted_at', NULL)
            ->findAll();

        return json_encode($faq);
    }

    public function contactUsView($id)
    {
        $contactUsModel = new ContactUsModel();

        $contactUs = $contactUsModel->where('id', $id)->first();

        return view('admin/customer_pages/edit_contact_us', compact('contactUs', 'id'));
    }

    public function faqView($id)
    {
        $faqModel = new FaqModel();

        $faq = $faqModel->where('id', $id)->first();

        return view('admin/customer_pages/edit_faq', compact('faq', 'id'));
    }

    public function contactUsUpdate($id)
    {
        $session = session();
        $contactUsModel = new ContactUsModel();
        try {
            $data = $this->request->getPost();
            $data_update = [
                'phone' => $data['contact_us_phone'],
                'email' => $data['contact_us_email'],
                'updated_at' => date(("Y-m-d H:i:s.000"), strtotime("Now")),
                'user_id' => $_SESSION['id'],
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

    public function faqUpdate($id)
    {
        $session = session();
        $faqModel = new FaqModel();
        try {
            $data = $this->request->getPost();

            if ($data['faq_question'] == "" || $data['faq_answer'] == "") {
                $session->setFlashdata('insertEmpty', 'Upload Failed, Please Try Again');
                return redirect()->to(base_url('admin/customer_pages/faq/view') . '/' . $id);
            }

            $data_update = [
                'question' => $data['faq_question'],
                'answer' => $data['faq_answer'],
                'updated_at' => date(("Y-m-d H:i:s.000"), strtotime("Now")),
                'user_id' => $_SESSION['id'],
            ];

            $faqModel->update($id, $data_update);

            $session->setFlashdata('updateSuccessful', 'abc');
            return redirect()->to(base_url('admin/customer_pages/faq'));
        } catch (Exception $e) {
            $session->setFlashdata('updateFailed', 'Update Failed, Please Try Again');
            return redirect()->to(base_url('admin/customer_pages/faq/view') . '/' . $id);
        }
        return redirect()->to(base_url('admin/customer_pages/faq/view') . '/' . $id);
    }

    public function faqStore()
    {
        $session = session();
        $faqModel = new FaqModel();
        try {
            $data = $this->request->getPost();

            if ($data['faq_question'] == "" || $data['faq_answer'] == "") {
                $session->setFlashdata('insertEmpty', 'Upload Failed, Please Try Again');
                return redirect()->to(base_url('admin/customer_pages/add_faq'));
            }

            $data_insert = [
                'question' => $data['faq_question'],
                'answer' => $data['faq_answer'],
                'user_id' => $_SESSION['id'],
            ];

            $faqModel->insert($data_insert);

            $session->setFlashdata('insertSuccessful', 'abc');
            return redirect()->to(base_url('admin/customer_pages/faq'));
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('admin/customer_pages/add_faq'));
        }
        return redirect()->to(base_url('admin/customer_pages/add_faq'));
    }

    public function faqDelete($id)
    {
        $session = session();
        $faqModel = new FaqModel();

        $faq_deleted = $faqModel->where('id', $id)->first();

        $faqModel->where('id', $id)->delete();

        $faq = $faqModel->where('deleted_at', NULL)
            ->findAll();
        $count_faq = count($faq);

        $session->setFlashdata('deleteFaq', '.');

        return view('admin/customer_pages/faq', compact('faq_deleted', 'count_faq'));
    }
}
