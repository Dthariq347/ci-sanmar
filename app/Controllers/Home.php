<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('index.php', $data);
    }

    public function sendmail()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'A name is required.',
                    'alpha_space' => 'Name must be a letter.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'A email is required.',
                    'valid_email' => 'Email not valid.'
                ]
            ],
            'phone' => [
                'rules' => 'required|numeric|max_length[13]',
                'errors' => [
                    'required' => 'A number is required.',
                    'numeric' => 'Phone number must be a number.',
                    'max_length' => 'Phone max digit is 13.'
                ]
            ],
            'message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'A message is required.'
                ]
            ]
        ])) {
            return redirect()->to('/home')->withInput();
        } else {
            $name = $this->request->getVar('name');
            $email = $this->request->getVar('email');
            $phone = $this->request->getVar('phone');
            $message = $this->request->getVar('message');
            $mail = new PHPMailer(true);
            try {
                //untuk konfigurasi yang lebih jelas dan detail, lihat link refresi guide yang sudah diberikan
                $mail->isSMTP();
                $mail->Host = '';
                $mail->SMTPAuth = true;
                //bisa diisi dengan username webmail dan pass webamil 
                $mail->Username = '';
                $mail->Password = '';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = '587';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                //bisa diisi dengan webmail 
                $mail->setFrom('');
                $mail->addAddress('');

                $mail->isHTML(true);
                $mail->Subject = "Ini test php mailer";
                $mail->Body = "
                <h3>
                Name : $name <br>
                Email : $email <br>
                Phone : $phone <br>
                Message : $message
                </h3>
                
                ";

                // $mail->send();
                $alert = 'Message sent successfully.';
            } catch (Exception $e) {
                // $alert = $e->getMessage();
                $alert = "Message failed to send.";
            }
            // session()->setFlashdata('pesan', $alert);
            // return redirect()->to('/home');


            $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
            $userIp = $this->request->getIPAddress();
            //bisa diisi dengan secreat google recaptcha yang telah dibuat
            $secret = '';

            $credential = array(
                'secret' => $secret,
                'response' => $this->request->getVar('g-recaptcha-response')
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);

            $status = json_decode($response, true);

            if ($status['success']) {
                session()->setFlashdata('pesan', $alert);
                $mail->send();
                return redirect()->to('/home');
            } else {
                $alert = 'Something went Wrong.';
                session()->setFlashdata('pesan', $alert);
                return redirect()->to('/home');
            }
        }
    }
}

