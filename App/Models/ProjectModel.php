<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Project;

class ProjectModel extends DbConnect {

    // Affichage total
    public function findAll(){
        $this->request = "SELECT * FROM Projects";
        $result = $this->connexion->query($this->request);
        $list = $result->fetchAll();
        return $list;
    } 
    public function find(int $id)
    {
        $this->request = $this->connexion->prepare("SELECT * FROM Projects WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        $project = $this->request->fetch();
        return $project;
    }
    /* Création */
    public function create(Project $project){
        $this->request = $this->connexion->prepare("INSERT INTO Projects VALUES (NULL, :title, :description, :project_link, :project_image, :creation_date)");
        $this->request->bindValue(":title", $project->getTitle());
        $this->request->bindValue(":description", $project->getDescription());
        $this->request->bindValue(":project_link", $project->getProjectLink());
        $this->request->bindValue(":project_image", $project->getProjectImage());
        $this->request->bindValue(":creation_date", $project->getCreationDate());
        $this->executeTryCatch();
    }

    public function update(int $id, Project $project){
        $this->request = $this->connexion->prepare("UPDATE Projects SET description = :description, project_image = :project_image WHERE id = :id");
        $this->request->bindValue(":description", $project->getDescription());
        $this->request->bindValue(":project_image", $project->getProjectImage());
        $this->request->bindValue(":id", $id);
        $this->executeTryCatch();
    }    

    /* Suppression */
    public function delete(int $id){
        $this->request = $this->connexion->prepare("DELETE FROM Projects WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->executeTryCatch();
    }

    private function executeTryCatch()
    {
        try {
            $this->request->execute();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        //Ferme le curseur, permettant à la requête d'être de nouveau exécutée
        $this->request->closeCursor();
    }
}