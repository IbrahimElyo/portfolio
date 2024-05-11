<?php

namespace App\Controllers;

use App\Core\Form;
use App\Entities\Presentation;
use App\Models\PresentationModel;
use App\Models\SkillModel;
use App\Models\HobbyModel;

class PresentationController extends Controller {
    public function index()
    {
        $presentation = new PresentationModel();

        $list = $presentation->findAll();

        $this->render('presentation/index', ['list' => $list]);
    }

    public function showPresentation($id)
    {
        //Extrait la valeur de l'identifiant à partir du tableau
        $presentationId = intval($id["id"]);

        //Instanciation de la classe PresentationModel
        $presentations = new PresentationModel();

        //Je stocke dans une variable le retour de la méthode find()
        $presentation = $presentations->find($presentationId);

        $this->render('presentation/showPresentation', ['presentation' => $presentation]);
    }
    public function displayPresentation($id)
    {

        $hobbies = new HobbyModel();

        $hobby = $hobbies->findAll();
        
        $skills = new SkillModel();

        $skill = $skills->findAll();

        //Instanciation de la classe PresentationModel
        $presentations = new PresentationModel();

        //Je stocke dans une variable le retour de la méthode find()
        $presentation = $presentations->findAll();

        $this->render('presentation/displayPresentation', ['presentation' => $presentation, "skill" => $skill, "hobby" => $hobby]);
    }
    public function add(){

        if(Form::validatePost($_POST, ['full-name', 'about-me', 'phone-number', 'readme', 'website-url', "address"])){

            //instanciation entité Presentation
            $presentation = new Presentation();

            // hydratation de l'instance
            $presentation->setFullName($_POST['full-name']);
            $presentation->setAboutMe($_POST['about-me']);
            $presentation->setPhoneNumber($_POST['phone-number']);
            $presentation->setReadme($_POST['readme']);
            $presentation->setWebSiteUrl($_POST['website-url']);
            $presentation->setAddress($_POST['address']);

            //instanciation du model Presentation
            $model = new PresentationModel();
            $model->create($presentation);      
            
            // redirection de l'admin vers la liste des presentations
            header("Location: index.php?controller=presentation&action=index");
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }

        //instanciation de la classe Form pour construire le formulaire d'ajout
        $form = new Form();

        //formulaire
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("full-name", "Full name", ["class" => "form-label"]);
        $form->addInput("text", "full-name", ["id" => "full-name", "class" => "form-control", "placeholder" => "add full name"]);
        $form->addLabel("about-me", "About me", ["class" => "form-label"]);
        $form->addInput("text", "about-me", ["id" => "about-me", "class" => "form-control", "placeholder" => "add about me"]);
        $form->addLabel("phone-number", "Phone number", ["class" => "form-label"]);
        $form->addInput("text", "phone-number", ["id" => "phone-number", "class" => "form-control", "placeholder" => "add phone number"]);
        $form->addLabel("readme", "E-mail", ["class" => "form-label"]);
        $form->addInput("readme", "readme", ["id" => "readme", "class" => "form-control", "placeholder" => "add readme"]);
        $form->addLabel("website-url", "Website url", ["class" => "form-label"]);
        $form->addInput("text", "website-url", ["id" => "website-url", "class" => "form-control", "placeholder" => "add website url"]);
        $form->addLabel("address", "Address", ["class" => "form-label"]);
        $form->addInput("text", "address", ["id" => "address", "class" => "form-control", "placeholder" => "add address"]);
        $form->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn-form"]);
        $form->endForm();
        
        $this->render("presentation/add", ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

    //méthode pour la mise à jour d'une presentation
    public function updatePresentation($id)
    {

        $erreur = '';

        // $id en entier
        $id = (int) $_GET['id'];

 
        if(Form::validatePost($_POST, ['full-name', 'about-me', 'phone-number', 'readme', 'website-url', "address"])){

            //instanciation entité Presentation
            $presentation = new Presentation();

            // hydratation de l'instance
            $presentation->setFullName($_POST['full-name']);
            $presentation->setAboutMe($_POST['about-me']);
            $presentation->setPhoneNumber($_POST['phone-number']);
            $presentation->setReadme($_POST['readme']);
            $presentation->setWebSiteUrl($_POST['website-url']);
            $presentation->setAddress($_POST['address']);

            $presentations = new PresentationModel();

            $presentations->update($id, $presentation);

            header("Location:index.php?controller=presentation&action=index");
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }

        // Instanciation de la classe PresentationModel
        $presentations = new PresentationModel();

        // Je stocke dans une variable le retour de la méthode find()
        $presentation = $presentations->find($id);

        $form = new Form();

        //formulaire
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("full-name", "Full name", ["class" => "form-label"]);
        $form->addInput("text", "full-name", ["id" => "full-name", "class" => "form-control", "placeholder" => "add full name", "value" => $presentation->full_name]);
        $form->addLabel("about-me", "About me", ["class" => "form-label"]);
        $form->addInput("text", "about-me", ["id" => "about-me", "class" => "form-control", "placeholder" => "add about me", "value" => $presentation->about_me]);
        $form->addLabel("phone-number", "Phone number", ["class" => "form-label"]);
        $form->addInput("text", "phone-number", ["id" => "phone-number", "class" => "form-control", "placeholder" => "add phone number", "value" => $presentation->phone_number]);
        $form->addLabel("readme", "E-mail", ["class" => "form-label"]);
        $form->addInput("readme", "readme", ["id" => "readme", "class" => "form-control", "placeholder" => "add readme", "value" => $presentation->readme]);
        $form->addLabel("website-url", "Website url", ["class" => "form-label"]);
        $form->addInput("text", "website-url", ["id" => "website-url", "class" => "form-control", "placeholder" => "add website url", "value" => $presentation->website_url]);
        $form->addLabel("address", "Address", ["class" => "form-label"]);
        $form->addInput("text", "address", ["id" => "address", "class" => "form-control", "placeholder" => "add address", "value" => $presentation->address]);
        $form->addInput("submit", "add", ["value" => "Mettre à jour", "class" => "btn-form"]);
        $form->endForm();

        $this->render("presentation/updatePresentation", ["updateForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

    //méthode pour la suppression d'une presentation
    public function deletePresentation($id){

        // $id en entier
        $id = (int)$_GET['id'];

        if(isset($_POST['true'])){
            //instanciation de la classe PresentationModel pour exécuter la méthode delete()
            $presentations = new PresentationModel();
            $presentations->delete($id);

            //redirection vers la liste des presentations
            header("Location:index.php?controller=presentation&action=index");
        } elseif(isset($_POST['false'])){
            //redirection vers la liste des presentations directement
            header("Location:index.php?controller=presentation&action=index");
        } else {
            //on récupère l'presentation avec la méthode find()
            $presentations = new PresentationModel();
            $presentation = $presentations->find($id);
        }
        $this->render('presentation/deletePresentation', ["presentation" => $presentation]);
        
    }

}