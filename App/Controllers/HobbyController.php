<?php

namespace App\Controllers;

use App\Core\Form;
use App\Entities\Hobby;
use App\Models\HobbyModel;

class HobbyController extends Controller {
    public function index()
    {
        $hobbies = new HobbyModel();

        $list = $hobbies->findAll();

        $this->render('hobby/index', ['list' => $list]);
    }
    public function showHobby($id){
        $hobbyId = intval($id["id"]);

        $hobbies = new HobbyModel();

        $hobby = $hobbies->find($hobbyId);

        $this->render('hobby/showHobby', ["hobby" => $hobby]);
    }

    public function add(){
        if(Form::validatePost($_POST, ['hobby-name', 'description', 'icon'])){

            //instanciation entité Hobby
            $hobby = new Hobby();

            // hydratation de l'instance
            $hobby->setHobbyName($_POST['hobby-name']);
            $hobby->setDescription($_POST['description']);
            $hobby->setIcon($_POST['icon']);

            //instanciation du model Hobby
            $model = new HobbyModel();
            $model->create($hobby);
            
            // redirection de l'admin vers la liste des presentations
            header("Location: index.php?controller=hobby&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
        //instanciation de la classe Form pour construire le formulaire d'ajout
        $form = new Form();

        //formulaire
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("hobby-name", "Hobby name", ["class" => "form-label"]);
        $form->addInput("text", "hobby-name", ["id" => "hobby-name", "class" => "form-control", "placeholder" => "add hobby name"]);
        $form->addLabel("description", "Description", ["class" => "form-label"]);
        $form->addInput("text", "description", ["id" => "description", "class" => "form-control", "placeholder" => "add description"]);
        $form->addLabel("icon", "Icon", ["class" => "form-label"]);
        $form->addInput("text", "icon", ["id" => "icon", "class" => "form-control", "placeholder" => "add icon"]);
        $form->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn-form"]);
        $form->endForm();
        
        $this->render("hobby/add", ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }
    
    /* Update */
    public function updateHobby($id){
        $erreur = '';

        //$id en entier
        $id = (int)$_GET['id'];

        if(Form::validatePost($_POST, ['hobby-name', 'description', 'icon'])){
            //instanciation entité Hobby
            $hobby = new Hobby();

            // hydratation de l'instance
            $hobby->setHobbyName($_POST['hobby-name']);
            $hobby->setDescription($_POST['description']);
            $hobby->setIcon($_POST['icon']);

            //instanciation du model Hobby
            $hobbies = new HobbyModel();
            $hobbies->update($id, $hobby);
            
            // redirection de l'admin vers la liste des Hobbies
            header("Location: index.php?controller=hobby&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
            // Instanciation de la classe HobbyModel
            $hobbies = new HobbyModel();
            
            // Je stocke dans une variable le retour de la méthode find()
            $hobby = $hobbies->find($id);

            $form = new Form();

            //formulaire
            $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
            $form->addLabel("hobby-name", "Hobby name", ["class" => "form-label"]);
            $form->addInput("text", "hobby-name", ["id" => "hobby-name", "class" => "form-control", "placeholder" => "add hobby name", "value" => $hobby->hobby_name]);
            $form->addLabel("description", "Description", ["class" => "form-label"]);
            $form->addInput("text", "description", ["id" => "description", "class" => "form-control", "placeholder" => "add description", "value" => $hobby->description]);
            $form->addLabel("icon", "Icon", ["class" => "form-label"]);
            $form->addInput("text", "icon", ["id" => "icon", "class" => "form-control", "placeholder" => "add icon", "value" => $hobby->icon]);
            $form->addInput("submit", "add", ["value" => "Mettre à jour", "class" => "btn-form"]);
            $form->endForm();
            
            $this->render("hobby/updateHobby", ["updateForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

    /* Méthode pour la suppression d'un Hobby */
    public function deleteHobby($id){

        // $id en entier
        $id = (int)$_GET['id'];

        if(isset($_POST['true'])){
            //instanciation de la classe HobbyModel pour exécuter la méthode delete()
            $hobbies = new HobbyModel();
            $hobbies->delete($id);

            //redirection vers la liste des hobbies
            header("Location:index.php?controller=hobby&action=index");
        } elseif(isset($_POST['false'])){
            //redirection vers la liste des hobbies directement
            header("Location:index.php?controller=hobby&action=index");
        } else {
            //on récupère le hobby avec la méthode find()
            $hobbies = new HobbyModel();
            $hobby = $hobbies->find($id);
        }
        $this->render('hobby/deleteHobby', ["hobby" => $hobby]);
        
    }
}