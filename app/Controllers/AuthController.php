<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;

class AuthController extends BaseController
{
    private $salt, $iv, $key, $method;

    // Encryption Key

    function __construct()
    {
        $this->salt = "59731B52B3EC58FA";
        $this->key = "05788993F8E4CE6A";
        $this->iv = "46060159617A8U7J";
        $this->method = "AES-128-CBC";
    }

    public function admin()
    {
        return view('auth/login_admin');
    }

    public function forbidden()
    {
        return view('forbidden');
    }

    public function adminForgotPassword()
    {
        return view('auth/forgot_password_admin');
    }

    public function loginAdmin()
    {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->where('password', $password)->where('is_active', 1)->first();

        if (isset($user)) {
            // If login is successful
            $session_data = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'isLoggedIn' => TRUE,
                'role' => $user['role'],
            ];
            $session->set($session_data);
            $session->setFlashdata('login_successful', $user['name']);

            if ($user['role'] == "owner" || $user['role'] == "manager") {
                return redirect()->to('admin/dashboard');
            } else {
                return redirect()->to('admin/order');
            }
        } else {
            // If login is not successful
            $session->setFlashdata('login_failed', "failed");

            return redirect()->to('login/admin');
        }
    }

    public function adminForgotAuth()
    {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
        if (!isset($user)) {
            $session->setFlashdata('user_not_failed', 'User Not Found!');
            return redirect()->to('forgot_password/admin/index');
        } else {
            $encrypted_token = md5($user['email']);
            $url_changepass = base_url('forgot_password/admin/change_pass') . "/" . $encrypted_token;
            $email = \Config\Services::email();
            $email->setFrom('sinarterang.adm@gmail.com', "Admin Sinar Terang");
            $email->setTo($user['email']);
            $email->setSubject('Reset Admin Passsword Sinar Terang');
            $email->setMessage('
            <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
                <html>
                <head>
                    <!-- Compiled with Bootstrap Email version: 1.1.2 --><meta http-equiv="x-ua-compatible" content="ie=edge">
                    <meta name="x-apple-disable-message-reformatting">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <style type="text/css">
                    body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}.p-4:not(table),.p-4:not(.btn)>tbody>tr>td,.p-4.btn td a{padding:16px !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-5>tbody>tr>td{font-size:20px !important;line-height:20px !important;height:20px !important}}
                    </style>
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                </head>
                <body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                    <table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                    <tbody>
                        <tr>
                        <td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">
                            <table class="container-fluid" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tbody>
                                <tr>
                                <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 0 16px;" align="left">
                                    <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                    <tbody>
                                        <tr>
                                        <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                            &#160;
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table class="card" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;" bgcolor="#ffffff">
                                    <tbody>
                                        <tr>
                                        <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left" bgcolor="#ffffff">
                                            <table class="card-body" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;" align="left">
                                                    <div style="background-color: #0d152d; color: #FFFFFF; padding: 20px 0px 20px 20px;">
                                                    <div class="row" style="margin-right: -24px;">
                                                        <table class="" role="presentation" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed; width: 100%;" width="100%">
                                                        <tbody>
                                                            <tr>
                                                            <div style="display: flex;">
                                                                <img class="img-fluid" src="https://drive.google.com/uc?export=view&id=1dsn10JbEVjR50K_-0_wG1iuH0czsnc31" allow="autoplay" alt="Sinar Terang" style="display: block; width: auto; height: 100px; max-width: 100%; max-height: 90%; line-height: 100%; outline: none; text-decoration: none; display: block; border-style: none; border-width: 0;">
                                                                <div style="margin: auto 0; width: 50%; padding:25px">
                                                                <h2 style="font-weight: bold; font-size: 4vmin; padding-top: 0; padding-bottom: 0; vertical-align: center; line-height: 38.4px; margin: 0;" align="LEFT">Sinar Terang</h2>
                                                                </div>
                                                            </div>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                    <table class="p-4" role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody style="font-family: Roboto, sans-serif;">
                                                        <tr>
                                                        <td style="line-height: 24px; font-size: 16px; margin: 0; padding: 16px;" align="left">
                                                            <div class="">
                                                            <h5 class="text-muted" style="font-size: 2vmin; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="left">Reset Password</h5>
                                                            <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                    &#160;
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <p style="font-size: 1.8vmin; line-height: 24px; width: 100%; margin: 0;" align="left">Hello ' . ucwords($user['name']) . ', Your Sinar Terang admin account has just requested a password change, please click the button below to continue</p>
                                                            <br>
                                                            <table class="btn" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important;">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="line-height: 24px; font-size: 16px; border-radius: 6px; margin: 0;" align="center">
                                                                    <a href="' . $url_changepass . '" style="font-size: 2vh; background-color: #0d152d; color: #FFFFFF; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: normal; white-space: nowrap; padding: 8px 12px; border: 1px solid transparent;">
                                                                        Reset Your Password
                                                                    </a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                    <h5 class="text-muted  text-center" style="font-size: 1.5vh; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="center">&#169; Sinar Terang</h5>
                                                    <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                    <tbody>
                                                        <tr>
                                                        <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                            &#160;
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                    <tbody>
                                        <tr>
                                        <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                            &#160;
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </body>
                </html>
            ');
            if ($email->send()) {
                $session->setFlashdata('email_sent', 'Please check your Email!');
                return redirect()->to('login/admin');
            } else {
                $session->setFlashdata('email_failed', 'Email failed to be sent, Please try again later!');
                return redirect()->to('forgot_password/admin/index');
            }
            $session->setFlashdata('email_sent', 'Please check your Email!');
            return redirect()->to('login/admin');
        }
    }

    public function adminForgotChange($token)
    {
        return view('auth/change_password_admin', compact('token'));
    }

    public function adminForgotNew($token)
    {
        $session = session();
        $data = $this->request->getPost();

        $encrypted_email = md5($data['email']);

        if ($data['password'] != $data['confirm_password']) {
            $session->setFlashdata('password_different', "failed");
            return redirect()->to('forgot_password/admin/change_pass/' . $token);
        }
        if ($token == $encrypted_email) {
            $data_update = [
                'password' => md5($data["password"]),
            ];
            $userModel = new UserModel();
            $user = $userModel->where('email', $data['email'])->first();

            $userModel->update($user['id'], $data_update);

            $session->setFlashdata('password_changed', 'Success');
            return redirect()->to('login/admin');
        } else {
            $session->setFlashdata('email_incorrect', 'Email is incorrect!');
            return redirect()->to('forgot_password/admin/change_pass/' . $token);
        }
        return redirect()->to('forgot_password/admin/change_pass/' . $token);
    }

    public function logout()
    {
        $session = session();
        session_unset();
        $session->setFlashdata('logout_successful', "success");
        return redirect()->to('/');
    }

    public function aes128Encrypt($data)
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);

        $plaintext = [
            "name" => $data['full_name'],
            "email" => $data['email'],
            "phone" => $data['phone'],
            "password" => md5($data['password']),
        ];

        $plain = json_encode($plaintext, TRUE);

        $ciphertext_raw = openssl_encrypt($plain, $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv);

        $ciphertext = base64_encode($ciphertext_raw);

        $ciphertext = AuthController::ToBase64UrlString($ciphertext);

        return $ciphertext;
    }

    public function aes128Decrypt($ciphertext_raw)
    {

        $ciphertext_raw = AuthController::FromBase64UrlString($ciphertext_raw);

        $ciphertext = base64_decode($ciphertext_raw);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_decrypt($ciphertext, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $this->iv);

        $data_decrypt = json_decode($ciphertext_raw, TRUE);

        return $data_decrypt;
    }

    // Replace "/" and "+" with "_" and "-" because ciphertext will be sent through URL
    public function ToBase64UrlString($text)
    {
        $step_1 = str_replace("/", "_", $text);
        $step_2 = str_replace("+", "-", $step_1);
        return $step_2;
    }

    // Replace "_" and "-" with "/" and "+" because ciphertext will be read by system
    public function FromBase64UrlString($text)
    {
        $step_1 = str_replace("_", "/", $text);
        $step_2 = str_replace("-", "+", $step_1);
        return $step_2;
    }
}
