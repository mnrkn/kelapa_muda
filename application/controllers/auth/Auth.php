<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('models/Auth_model');
    }

    public function forgot_password()
    {
        $this->load->view('auth/forgot_password');
    }

    public function reset_password()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $email = $this->input->post('email');

            // Memeriksa apakah email terdaftar
            $user = $this->auth_model->getUserByEmail($email);

            if ($user) {
                // Mengenerate password baru
                $newPassword = $this->generateRandomPassword();

                // Mengupdate password pengguna
                $this->auth_model->updateUserPassword($user['id'], $newPassword);

                // Mengirim email dengan password baru ke pengguna
                $this->sendEmail($email, 'Reset Password', 'Your new password: ' . $newPassword);

                echo 'Password reset successfully. Please check your email for the new password.';
            } else {
                echo 'User not found.';
            }
        }
    }

    private function generateRandomPassword()
    {
        // Mengenerate password acak
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
    }

    private function sendEmail($to, $subject, $message)
    {
        // Mengirim email menggunakan library atau fungsi yang sesuai
        // Contoh: menggunakan PHPMailer atau fungsi mail() bawaan PHP
    }

}
