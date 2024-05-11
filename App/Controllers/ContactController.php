<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../Core/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../Core/PHPMailer/src/PHPMailer.php';

class ContactController extends Controller {
    public function displayContact()
    {

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        $this->render('contact/displayContact', ['csrf_token' => $token]);
    }
    public function formSubmitted(){

        $feedback = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                $feedback = 'Invalid CSRF token.';
            }

            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);
    
            $mail = new PHPMailer(true);
            try {
                // Configuration de PHPMailer
                $mail->setFrom('kitule40@gmail.com', $name);
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Portfolio Ibrahim";
                $mail->Body = $message;
    
                $mail->send();
                $feedback = 'Message sent successfully!';
            } catch (Exception $e) {
                $feedback = "Failed to send message: " . $mail->ErrorInfo;
            }
        }

        $this->render('contact/formSubmitted', ['feedback' => $feedback]);
    }
    
}
