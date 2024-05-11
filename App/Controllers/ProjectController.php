<?php

namespace App\Controllers;

use App\Core\Form;
use App\Entities\Project;
use App\Models\ProjectModel;
use App\Models\SkillModel;

class ProjectController extends Controller {
    public function index()
    {
        $projects = new ProjectModel();

        $list = $projects->findAll();
        
        $this->render("project/index", ["list" => $list]);
    }
    public function displayProject()
    {
        
        $skills = new SkillModel();

        $skill = $skills->findAll();

        $projects = new ProjectModel();

        $project = $projects->findAll();
        
        $this->render("project/displayProject", ["project" => $project, "skill" => $skill]);
    }
    
    
    public function showProject($id){
        $projectId = intval($id["id"]);

        $projects = new ProjectModel();

        $project = $projects->find($projectId);

        $this->render('project/showProject', ["project" => $project]);
    }

    public function add(){
        if(Form::validatePost($_POST, ['title', 'description', 'project-link', 'project-image', 'creation-date'])){

            //instanciation entité Project
            $project = new Project();

            // hydratation de l'instance
            $project->setTitle($_POST['title']);
            $project->setDescription($_POST['description']);
            $project->setProjectLink($_POST['project-link']);
            $project->setProjectImage($_POST['project-image']);
            $project->setCreationDate($_POST['creation-date']);

            //instanciation du model Project
            $model = new ProjectModel();
            $model->create($project);
            
            // redirection de l'admin vers la liste des presentations
            header("Location: index.php?controller=project&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
        //instanciation de la classe Form pour construire le formulaire d'ajout
        $form = new Form();

        //formulaire
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("title", "Title", ["class" => "form-label"]);
        $form->addInput("text", "title", ["id" => "title", "class" => "form-control", "placeholder" => "add title"]);
        $form->addLabel("description", "Description", ["class" => "form-label"]);
        $form->addInput("text", "description", ["id" => "description", "class" => "form-control", "placeholder" => "add description"]);
        $form->addLabel("project-link", "Project link", ["class" => "form-label"]);
        $form->addInput("text", "project-link", ["id" => "project-link", "class" => "form-control", "placeholder" => "add project link"]);
        $form->addLabel("project-image", "Project image", ["class" => "form-label"]);
        $form->addInput("text", "project-image", ["id" => "project-image", "class" => "form-control", "placeholder" => "add project image"]);
        $form->addLabel("creation-date", "Creation date", ["class" => "form-label"]);
        $form->addInput("date", "creation-date", ["id" => "creation-date", "class" => "form-control", "placeholder" => "add creation date"]);
        $form->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn-form"]);
        $form->endForm();
        
        $this->render("project/add", ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }
    
    /* Update */
    public function updateProject($id){
        $erreur = '';

        //$id en entier
        $id = (int)$_GET['id'];

        if(Form::validatePost($_POST, ['title', 'description', 'project-link', 'project-image', 'creation-date'])){
            //instanciation entité Project
            $project = new Project();

            // hydratation de l'instance
            $project->setTitle($_POST['title']);
            $project->setDescription($_POST['description']);
            $project->setProjectLink($_POST['project-link']);
            $project->setProjectImage($_POST['project-image']);
            $project->setCreationDate($_POST['creation-date']);

            //instanciation du model Project
            $projects = new ProjectModel();
            $projects->update($id, $project);
            
            // redirection de l'admin vers la liste des Projects
            header("Location: index.php?controller=project&action=index");
                
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }
            // Instanciation de la classe ProjectModel
            $projects = new ProjectModel();
            
            // Je stocke dans une variable le retour de la méthode find()
            $project = $projects->find($id);

            $form = new Form();

             //formulaire
            $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
            $form->addLabel("title", "Title", ["class" => "form-label"]);
            $form->addInput("text", "title", ["id" => "title", "class" => "form-control", "placeholder" => "add title", "value" => $project->title]);
            $form->addLabel("description", "Description", ["class" => "form-label"]);
            $form->addInput("text", "description", ["id" => "description", "class" => "form-control", "placeholder" => "add description", "value" => $project->description]);
            $form->addLabel("project-link", "Project link", ["class" => "form-label"]);
            $form->addInput("text", "project-link", ["id" => "project-link", "class" => "form-control", "placeholder" => "add project link", "value" => $project->project_link]);
            $form->addLabel("project-image", "Project image", ["class" => "form-label"]);
            $form->addInput("text", "project-image", ["id" => "project-image", "class" => "form-control", "placeholder" => "add project image", "value" => $project->project_image]);
            $form->addLabel("creation-date", "Creation date", ["class" => "form-label"]);
            $form->addInput("date", "creation-date", ["id" => "creation-date", "class" => "form-control", "placeholder" => "add creation date","value" => $project->creation_date]);
            $form->addInput("submit", "add", ["value" => "Mettre à jour", "class" => "btn-form"]);
            $form->endForm();
            
            $this->render("project/updateProject", ["updateForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

        /* Méthode pour la suppression d'un Project */
        public function deleteProject($id){

            // $id en entier
            $id = (int)$_GET['id'];

            if(isset($_POST['true'])){
                //instanciation de la classe ProjectModel pour exécuter la méthode delete()
                $projects = new ProjectModel();
                $projects->delete($id);

                //redirection vers la liste des projects
                header("Location:index.php?controller=project&action=index");
            } elseif(isset($_POST['false'])){
                //redirection vers la liste des projects directement
                header("Location:index.php?controller=project&action=index");
            } else {
                //on récupère le project avec la méthode find()
                $projects = new ProjectModel();
                $project = $projects->find($id);
            }
            $this->render('project/deleteProject', ["project" => $project]);
            
        }
}