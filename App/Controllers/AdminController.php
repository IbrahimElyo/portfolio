<?php

// Récupérer les données de la BDD pour la MAJ
namespace App\Controllers;

use App\Models\PresentationModel;
use App\Models\ProjectModel;
use App\Models\SkillModel;
use App\Models\HobbyModel;
use App\Entities\Presentation;
use App\Entities\Project;
use App\Entities\Hobby;
use App\Entities\Skill;
use App\Core\Form;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (isset($_SESSION['user']) && $_SESSION['is_admin']) {
            $this->render('admin/dashboard', 
            [
                "aboutForm" => $this->generateAboutForm(),
                "skillsForm" => $this->generateSkillsAndReadmeAndHobbiesForm(),
                "projectsForm" => $this->generateProjectsForm()
            ]);
        } else {
            header('Location: index.php?controller=auth&action=index&error=unauthorized');
            exit;
        }
    }

    public function deconnexion()
    {
        session_destroy();
        session_unset();
        header('Location: index.php?controller=auth&action=index');
        exit();
    }

    public function updateAbout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['about_id'];
            $presentation = new Presentation();

            $presentation->setFullName($_POST['full-name']);
            $presentation->setAboutMe($_POST['about-me']);

            $presentationModel = new PresentationModel();
            $presentationModel->update($id, $presentation);

            header('Location: index.php?controller=admin&action=dashboard');
            exit;
        }
    }
    public function updateProject()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST['project_id'] as $id => $value) {
                $project = new Project();
                $project->setDescription($_POST['project-description'][$id]);
                $project->setProjectImage($_POST['project-image'][$id]);
    
                $presentationModel = new ProjectModel();
                $presentationModel->update($id, $project);
            }
            header('Location: index.php?controller=admin&action=dashboard');
            exit;
        }
    }
    


    private function generateProjectsForm()
    {
        $projectData = new ProjectModel();
        $datas = $projectData->findAll();
    
        $form = new Form();
        $form->startForm("index.php?controller=admin&action=updateProject", "POST", ["enctype" => "multipart/form-data"]);
        if ($datas) {
            foreach ($datas as $data) {
                $form->addInput("hidden", "project_id[" . $data->id . "]", ["value" => $data->id]);
                $form->addLabel("project-description-" . $data->id, "Content for " . $data->project_link, ["class" => "form-label"]);
                $form->addTextarea("project-description[" . $data->id . "]", $data->description, ["rows" => 7]);
                $form->addLabel("project-image-" . $data->id, "URL for " . $data->project_link, ["class" => "form-label"]);
                $form->addInput("text", "project-image[" . $data->id . "]", ["value" => $data->project_image]);
            }
        }
        $form->addInput("submit", "update", ["value" => "Update", "class" => "btn-form update-button"]);
        $form->endForm();
        return $form->getFormElements();
    }
    

    public function updateSkillsAndReadmeAndHobbies()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $presentationId = $_POST['presentation_id'] ?? null;
            $presentation = new Presentation();

            if (!empty($_POST['readme'])) {
                $presentation->setReadme($_POST['readme']);
            }

            $presentationModel = new PresentationModel();
            $presentationModel->update($presentationId, $presentation);

            if (isset($_POST['skill_url'])) {
                foreach ($_POST['skill_url'] as $skillId => $skillUrl) {
                    if (!empty($skillUrl)) {
                        $skill = new Skill();
                        $skill->setSkillUrl($skillUrl);

                        $skillModel = new SkillModel();
                        $skillModel->update($skillId, $skill);
                    }
                }
            }
            if (isset($_POST['icon'])) {
                foreach ($_POST['icon'] as $hobbyId => $iconUrl) {
                    $hobbyModel = new HobbyModel();
                    $hobbyData = $hobbyModel->find($hobbyId);

                    if ($hobbyData instanceof Hobby) {
                        if (!empty($iconUrl)) {
                            $hobbyData->setIcon($iconUrl);
                            $hobbyModel->update($hobbyId, $hobbyData);
                        }
                    } else {
                        $hobby = new Hobby();
                        $hobby->setIcon($iconUrl);
                        $hobbyModel->update($hobbyId, $hobby);
                    }
                }

                header('Location: index.php?controller=admin&action=dashboard&update=success');
                exit;
            }
        }
    }

    // Méthodes de génération de formulaires
    private function generateAboutForm()
    {
        $presentationData = new PresentationModel();
        $datas = $presentationData->find(1);

        $form = new Form();
        $form->startForm("index.php?controller=admin&action=updateAbout", "POST", ["enctype" => "multipart/form-data"]);
        $form->addInput("hidden", "about_id", ["value" => $datas->id]);
        $form->addLabel("full-name", "Full name", ["class" => "form-label"]);
        $form->addInput("text", "full-name", ["id" => "full-name", "class" => "form-control", "value" => $datas->full_name]);
        $form->addLabel("about-me", "About me", ["class" => "form-label"]);
        $form->addTextarea("about-me", $datas->about_me ?? "", ["id" => "about-me", "class" => "form-control"]);
        $form->addInput("submit", "update", ["value" => "Update", "class" => "btn-form update-button"]);
        $form->endForm();
        return $form->getFormElements();
    }

    private function generateSkillsAndReadmeAndHobbiesForm()
    {
        $hobbiesData = new HobbyModel();
        $skillsData = new SkillModel();
        $presentationData = new PresentationModel();
        $hobbies = $hobbiesData->findAll();
        $presentation = $presentationData->find(1);
        $skills = $skillsData->findAll();
        $form = new Form();

        $form->startForm("index.php?controller=admin&action=updateSkillsAndReadmeAndHobbies", "POST", ["enctype" => "multipart/form-data"]);

        $form->addInput("hidden", "presentation_id", ["value" => $presentation->id]);
        $form->addLabel("readme", "Readme", ["class" => "form-label"]);
        $form->addTextarea("readme", $presentation->readme ?? "", ["id" => "readme", "class" => "form-control", "rows" => 5]);

        // Champs pour les Skills
        if ($skills) {
            foreach ($skills as $skill) {
                $form->addInput("hidden", "skills[" . $skill->id . "]", ["value" => $skill->id]);
                $form->addLabel("skill_url_" . $skill->id, "URL for " . $skill->skill_name, ["class" => "form-label"]);
                $form->addInput("text", "skill_url[" . $skill->id . "]", ["value" => $skill->skill_url]);
            }
        }

        // Champ pour les Hobbies
        if ($hobbies) {
            foreach ($hobbies as $hobby) {
                $form->addLabel("icon[" . $hobby->id . "]", "Hobby : " . $hobby->hobby_name, ["class" => "form-label"]);
                $form->addInput("text", "icon[" . $hobby->id . "]", ["value" => $hobby->icon, "class" => "form-control"]);
            }
        }


        $form->addInput("submit", "update", ["value" => "Update", "class" => "btn-form update-button"]);
        $form->endForm();
        return $form->getFormElements();
    }
}
