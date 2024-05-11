<?php

namespace App\Controllers;

use App\Core\Form;
use App\Entities\User;
use App\Models\UserModel;

class UserController extends Controller {
    public function index()
    {
        $users = new UserModel();

        $list = $users->findAll();
        $this->render("user/index", ["list" => $list]);
    }
    public function showUser($id){
        $userId = intval($id["id"]);

        $users = new UserModel();

        $user = $users->find($userId);

        $this->render('user/showUser', ["user" => $user]);
    }

    public function add(){
        if(Form::validatePost($_POST, ['username', 'password', 'email', 'profile-info', 'profile-photo'])){

            //instanciation entité User
            $user = new User();

            $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // hydratation de l'instance
            $user->setUsername($_POST['username']);
            $user->setPassword($hashedPassword);
            $user->setEmail($_POST['email']);
            $user->setProfileInfo($_POST['profile-info']);
            $user->setProfilePhoto($_POST['profile-photo']);

            //instanciation du model User
            $model = new UserModel();
            $model->create($user);
            
            // redirection de l'admin vers la liste des presentations
            header("Location: index.php?controller=user&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
        //instanciation de la classe Form pour construire le formulaire d'ajout
        $form = new Form();

        //formulaire
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("username", "Username", ["class" => "form-label"]);
        $form->addInput("text", "username", ["id" => "username", "class" => "form-control", "placeholder" => "add user name"]);
        $form->addLabel("password", "Password", ["class" => "form-label"]);
        $form->addInput("password", "password", ["id" => "password", "class" => "form-control", "placeholder" => "add password"]);
        $form->addLabel("email", "E-mail", ["class" => "form-label"]);
        $form->addInput("email", "email", ["id" => "email", "class" => "form-control", "placeholder" => "add e-mail"]);
        $form->addLabel("profile-info", "Profile info", ["class" => "form-label"]);
        $form->addInput("text", "profile-info", ["id" => "profile-info", "class" => "form-control", "placeholder" => "add profile info"]);
        $form->addLabel("profile-photo", "Profile photo", ["class" => "form-label"]);
        $form->addInput("text", "profile-photo", ["id" => "profile-photo", "class" => "form-control", "placeholder" => "add profile photo"]);
        $form->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn-form"]);
        $form->endForm();
        
        $this->render("user/add", ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }
    
    /* Update */
    public function updateUser($id){
        $erreur = '';

        //$id en entier
        $id = (int)$_GET['id'];

        if(Form::validatePost($_POST, ['username', 'password', 'email', 'profile-info', 'profile-photo'])){
            //instanciation entité User
            $user = new User();

            $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);

            // hydratation de l'instance
            $user->setUsername($_POST['username']);
            $user->setPassword($hashedPassword);
            $user->setEmail($_POST['email']);
            $user->setProfileInfo($_POST['profile-info']);
            $user->setProfilePhoto($_POST['profile-photo']);
            //instanciation du model User
            $users = new UserModel();
            $users->update($id, $user);
            
            // redirection de l'admin vers la liste des Users
            header("Location: index.php?controller=user&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
            // Instanciation de la classe UserModel
            $users = new UserModel();
            
            // Je stocke dans une variable le retour de la méthode find()
            $user = $users->find($id);

            $form = new Form();

            //formulaire
            $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
            $form->addLabel("username", "Username", ["class" => "form-label"]);
            $form->addInput("text", "username", ["id" => "username", "class" => "form-control", "placeholder" => "add user name", "value" => $user->username]);
            $form->addLabel("password", "Password", ["class" => "form-label"]);
            $form->addInput("password", "password", ["id" => "password", "class" => "form-control", "placeholder" => "add password", "value" => $user->password]);
            $form->addLabel("email", "E-mail", ["class" => "form-label"]);
            $form->addInput("email", "email", ["id" => "email", "class" => "form-control", "placeholder" => "add e-mail", "value" => $user->email]);
            $form->addLabel("profile-info", "Profile info", ["class" => "form-label"]);
            $form->addInput("text", "profile-info", ["id" => "profile-info", "class" => "form-control", "placeholder" => "add profile info", "value" => $user->profile_info]);
            $form->addLabel("profile-photo", "Profile photo", ["class" => "form-label"]);
            $form->addInput("text", "profile-photo", ["id" => "profile-photo", "class" => "form-control", "placeholder" => "add profile photo", "value" => $user->profile_photo]);
            $form->addInput("submit", "add", ["value" => "Mettre à jour", "class" => "btn-form"]);
            $form->endForm();
            
            $this->render("user/updateUser", ["updateForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

        /* Méthode pour la suppression d'un User */
        public function deleteUser($id){

            // $id en entier
            $id = (int)$_GET['id'];

            if(isset($_POST['true'])){
                //instanciation de la classe UserModel pour exécuter la méthode delete()
                $users = new UserModel();
                $users->delete($id);

                //redirection vers la liste des users
                header("Location:index.php?controller=user&action=index");
            } elseif(isset($_POST['false'])){
                //redirection vers la liste des users directement
                header("Location:index.php?controller=user&action=index");
            } else {
                //on récupère le user avec la méthode find()
                $users = new UserModel();
                $user = $users->find($id);
            }
            $this->render('user/deleteUser', ["user" => $user]);
            
        }
}