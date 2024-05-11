<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PresentationModel;

class AuthController extends Controller {
    public function index() {
        if (isset($_SESSION['user']) && $_SESSION['is_admin']) {
            header('Location: index.php?controller=admin&action=dashboard');
            exit;
        }
        $this->render('auth/index');
    }
    

    public function connexion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $userModel = new UserModel();
            $user = $userModel->findByUsername($username);
    
            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user'] = $user;
                $_SESSION['is_admin'] = true;
                header('Location: index.php?controller=admin&action=dashboard');
                exit;
            } else {
                $this->render('auth/index', ['error' => 'Identifiants incorrects']);
            }
        } else {
            $this->render('auth/index');
        }
    }
    
    
}
