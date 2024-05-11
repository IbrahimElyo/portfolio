<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Skill;

class SkillModel extends DbConnect {

    // Affichage total
    public function findAll(){
        $this->request = "SELECT * FROM Skills";
        $result = $this->connexion->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }
    public function find(int $id)
    {
        $this->request = $this->connexion->prepare("SELECT * FROM Skills WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        $skill = $this->request->fetch();
        return $skill;
    }
    /* Création */
    public function create(Skill $skill){
        $this->request = $this->connexion->prepare("INSERT INTO Skills VALUES (NULL, :skill_name, :skill_description, :skill_icon)");
        $this->request->bindValue(":skill_name", $skill->getSkillName());
        $this->request->bindValue(":skill_description", $skill->getSkillDescription());
        $this->request->bindValue(":skill_icon", $skill->getSkillIcon());
        $this->executeTryCatch();
    }
    
    public function update(int $id, Skill $skill){
        $this->request = $this->connexion->prepare("UPDATE Skills SET skill_url = :skill_url WHERE id = :id");
        $this->request->bindValue(":id", $id);
        $this->request->bindValue(":skill_url", $skill->getSkillUrl());
        $this->executeTryCatch();
    }
    
    

    /* Suppression */
    public function delete(int $id){
        $this->request = $this->connexion->prepare("DELETE FROM Skills WHERE id = :id");
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