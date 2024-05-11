<?php

namespace App\Controllers;

use App\Core\Form;
use App\Entities\Skill;
use App\Models\SkillModel;

class SkillController extends Controller {
    public function index()
    {

        $skills = new SkillModel();

        $list = $skills->findAll();

        error_reporting(E_ALL);
        
        $this->render("skill/index", ["list" => $list]);
    }
    public function showSkill($id){
        $skillId = intval($id["id"]);

        $skills = new SkillModel();

        $skill = $skills->find($skillId);

        $this->render('skill/showSkill', ["skill" => $skill]);
    }

    public function add(){
        if(Form::validatePost($_POST, ['skill-name', 'skill-description', 'skill-icon'])){

            //instanciation entité Skill
            $skill = new Skill();

            // hydratation de l'instance
            $skill->setSkillName($_POST['skill-name']);
            $skill->setSkillDescription($_POST['skill-description']);
            $skill->setSkillIcon($_POST['skill-icon']);

            //instanciation du model Skill
            $model = new SkillModel();
            $model->create($skill);
            
            // redirection de l'admin vers la liste des presentations
            header("Location: index.php?controller=skill&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
        //instanciation de la classe Form pour construire le formulaire d'ajout
        $form = new Form();

        //formulaire
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("skill-name", "Skill name", ["class" => "form-label"]);
        $form->addInput("text", "skill-name", ["id" => "skill-name", "class" => "form-control", "placeholder" => "add skill name"]);
        $form->addLabel("skill-description", "Skill description", ["class" => "form-label"]);
        $form->addInput("text", "skill-description", ["id" => "skill-description", "class" => "form-control", "placeholder" => "add skill description"]);
        $form->addLabel("skill-icon", "Icon", ["class" => "form-label"]);
        $form->addInput("text", "skill-icon", ["id" => "skill-icon", "class" => "form-control", "placeholder" => "skill icon"]);
        $form->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn-form"]);
        $form->endForm();
        
        $this->render("skill/add", ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }
    
    /* Update */
    public function updateSkill($id){
        $erreur = '';

        //$id en entier
        $id = (int)$_GET['id'];

        if(Form::validatePost($_POST, ['skill-name', 'skill-description', 'skill-icon'])){
            //instanciation entité Skill
            $skill = new Skill();

            // hydratation de l'instance
            $skill->setSkillName($_POST['skill-name']);
            $skill->setSkillDescription($_POST['skill-description']);
            $skill->setSkillIcon($_POST['skill-icon']);

            //instanciation du model Skill
            $skills = new SkillModel();
            $skills->update($id, $skill);
            
            // redirection de l'admin vers la liste des Skills
            header("Location: index.php?controller=skill&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
            // Instanciation de la classe SkillModel
            $skills = new SkillModel();
            
            // Je stocke dans une variable le retour de la méthode find()
            $skill = $skills->find($id);

            $form = new Form();

            //formulaire
            $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
            $form->addLabel("skill-name", "Skill name", ["class" => "form-label"]);
            $form->addInput("text", "skill-name", ["id" => "skill-name", "class" => "form-control", "placeholder" => "add skill name", "value" => $skill->skill_name]);
            $form->addLabel("skill-description", "Skill description", ["class" => "form-label"]);
            $form->addInput("text", "skill-description", ["id" => "skill-description", "class" => "form-control", "placeholder" => "add skill description", "value" => $skill->skill_description]);
            $form->addLabel("skill-icon", "Icon", ["class" => "form-label"]);
            $form->addInput("text", "skill-icon", ["id" => "skill-icon", "class" => "form-control", "placeholder" => "skill icon", "value" => $skill->skill_icon]);
            $form->addInput("submit", "add", ["value" => "Mettre à jour", "class" => "btn-form"]);
            $form->endForm();
            
            $this->render("skill/updateSkill", ["updateForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

        /* Méthode pour la suppression d'un Skill */
        public function deleteSkill($id){

            // $id en entier
            $id = (int)$_GET['id'];

            if(isset($_POST['true'])){
                //instanciation de la classe SkillModel pour exécuter la méthode delete()
                $skills = new SkillModel();
                $skills->delete($id);

                //redirection vers la liste des skills
                header("Location:index.php?controller=skill&action=index");
            } elseif(isset($_POST['false'])){
                //redirection vers la liste des skills directement
                header("Location:index.php?controller=skill&action=index");
            } else {
                //on récupère le skill avec la méthode find()
                $skills = new SkillModel();
                $skill = $skills->find($id);
            }
            $this->render('skill/deleteSkill', ["skill" => $skill]);
            
        }
}