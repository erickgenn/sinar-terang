<?php

namespace App\Controllers;

use App\Models\OutletModel;
use App\Models\ProductModel;
use Exception;

class OutletController extends BaseController
{
    public function index()
    {
        return view('admin/outlet/index');
    }

    public function add()
    {
        return view('admin/outlet/add_outlet');
    }

    public function view($id)
    {
        $outletModel = new OutletModel();
        $outlet = $outletModel->where('id', $id)->first();

        return view('admin/outlet/edit_outlet', compact('outlet', 'id'));
    }

    public function update($id)
    {
        $session = session();
        $outletModel = new OutletModel();
        try {
            $data = $this->request->getPost();
            // Upload image
            if ($_FILES['outlet_picture']['name'] == '') {
                try {
                    $data_update = [
                        'name' => $data['outlet_name'],
                        'location' => $data['outlet_location'],
                        'picture'  => $data['outlet_picture_default'],
                        'updated_at' => date(("Y-m-d H:i:s.000"), strtotime("Now")),
                        'user_id' => $_SESSION['id'],
                    ];
                    $outletModel->update($id, $data_update);

                    $session->setFlashdata('updateSuccessful', 'abc');
                    return redirect()->to(base_url('admin/outlet'));
                } catch (Exception $er) {
                    $session->setFlashdata('updateFailed', 'Update Failed, Please Try Again');
                    return redirect()->to(base_url('admin/outlet/view') . '/' . $id);
                }
            } else {
                $file = $this->request->getFile('outlet_picture');

                $target_dir = "uploads/outlet";
                $target_file = $target_dir . '/' . basename($file->getName());
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if (isset($file)) {
                    $check = getimagesize($file->getTempName());
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }

                // Check file size
                if ($file->getSize() > 7000000) {
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $session->setFlashdata('ImageFailed', 'Please Try Another Image');
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($file->getTempName(), $target_dir . '/' . $file->getName())) {
                        // upload to db
                        $data_update = [
                            'name' => $data['outlet_name'],
                            'location' => $data['outlet_location'],
                            'picture'    => $file->getName(),
                            'updated_at' => date("Y-m-d H:i:s.000"), strtotime("Now"),
                            'user_id' => $_SESSION['id'],
                        ];

                        $outletModel->update($id, $data_update);

                        $session->setFlashdata('updateSuccessful', 'abc');
                        return redirect()->to(base_url('admin/outlet'));
                    } else {
                        $session->setFlashdata('updateFailed', 'Upload Failed, Please Try Again');
                        return redirect()->to(base_url('admin/outlet/view') . '/' . $id);
                    }
                }
            }
        } catch (Exception $e) {
            $session->setFlashdata('updateFailed', 'Update Failed, Please Try Again');
            return redirect()->to(base_url('admin/outlet/view') . '/' . $id);
        }
        return redirect()->to(base_url('admin/outlet/view') . '/' . $id);
    }

    public function store()
    {
        $session = session();
        $outletModel = new OutletModel();
        try {
            $data = $this->request->getPost();
            // Upload image
            $file = $this->request->getFile('outlet_picture');

            $target_dir = "uploads/outlet";
            $target_file = $target_dir . '/' . basename($file->getName());
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($file)) {
                $check = getimagesize($file->getTempName());
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }

            // Check file size
            if ($file->getSize() > 7000000) {
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $session->setFlashdata('ImageFailed', 'Please Try Another Image');
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($file->getTempName(), $target_dir . '/' . $file->getName())) {
                    // upload to db
                    $data_insert = [
                        'name' => $data['outlet_name'],
                        'location' => $data['outlet_location'],
                        'user_id' => $_SESSION['id'],
                        'picture'    => $file->getName(),
                    ];

                    $outletModel->insert($data_insert);

                    $session->setFlashdata('insertSuccessful', 'abc');
                    return redirect()->to(base_url('admin/outlet'));
                } else {
                    $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
                    return redirect()->to(base_url('admin/add_outlet'));
                }
            }
        } catch (Exception $e) {
            $session->setFlashdata('insertFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('admin/add_outlet'));
        }
        return redirect()->to(base_url('admin/add_outlet'));
    }

    public function search()
    {
        $outletModel = new OutletModel();

        $outlet = $outletModel->where('deleted_at', NULL)
            ->findAll();

        return json_encode($outlet);
    }

    public function delete($id)
    {
        $session = session();
        $outletModel = new OutletModel();

        $data = [
            'is_active' => 0,
        ];

        $outletModel->update($id, $data);
        $outlet = $outletModel->where('id', $id)->first();

        $outletModel->where('id', $id)->delete();

        $session->setFlashdata('deleteOutlet', '.');

        return view('admin/outlet/index', compact('outlet'));
    }

    public function activate($id)
    {
        $session = session();
        $outletModel = new OutletModel();
        $data = [
            'is_active' => 1,
        ];

        $outletModel->update($id, $data);

        $outlet = $outletModel->where('id', $id)->first();

        $session->setFlashdata('activateOutlet', '.');

        return view('admin/outlet/index', compact('outlet'));
    }

    public function deactivate($id)
    {
        $session = session();
        $outletModel = new OutletModel();
        $data = [
            'is_active' => 0,
        ];
        $outletModel->update($id, $data);

        $outlet = $outletModel->where('id', $id)->first();

        $session->setFlashdata('deactivateOutlet', '.');

        return view('admin/outlet/index', compact('outlet'));
    }
}
