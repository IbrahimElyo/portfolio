<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Hobby;

class HobbyModel extends DbConnect {

    // Affichage total
    public function findAll()
    {
        $this->request = "SELECT * FROM Hobbies";
        $result = $this->connexion->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }

    public function find(int $id)
    {
        $this->request = $this->connexion->prepare("SELECT * FROM Hobbies WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        $hobby = $this->request->fetch();
        return $hobby;
    }
    /* Création */
    public function create(Hobby $hobby){
        $this->request = $this->connexion->prepare("INSERT INTO Hobbies VALUES (NULL, :hobby_name, :description, :icon)");
        $this->request->bindValue(":hobby_name", $hobby->getHobbyName());
        $this->request->bindValue(":description", $hobby->getDescription());
        $this->request->bindValue(":icon", $hobby->getIcon());
        $this->executeTryCatch();
    }
    
    /* Mise à jour */
    public function update(int $id, Hobby $hobby){
        // Préparer la requête avec des champs conditionnels
        $sql = "UPDATE Hobbies SET ";
        $params = [];
        $bindings = [];
    
        if ($hobby->getHobbyName() !== null) {
            $params[] = "hobby_name = :hobby_name";
            $bindings[':hobby_name'] = $hobby->getHobbyName();
        }
    
        if ($hobby->getDescription() !== null) {
            $params[] = "description = :description";
            $bindings[':description'] = $hobby->getDescription();
        }
    
        if ($hobby->getIcon() !== null) {
            $params[] = "icon = :icon";
            $bindings[':icon'] = $hobby->getIcon();
        }
    
        if (count($params) == 0) {
            // Aucune mise à jour nécessaire si aucun champ n'est modifié
            return;
        }
    
        // Compléter la requête
        $sql .= implode(", ", $params) . " WHERE id = :id";
        $bindings[':id'] = $id;
    
        // Préparer et exécuter la requête
        $this->request = $this->connexion->prepare($sql);
        foreach ($bindings as $key => $value) {
            $this->request->bindValue($key, $value);
        }
    
        $this->executeTryCatch();
    }
    

    /* Suppression */
    public function delete(int $id){
        $this->request = $this->connexion->prepare("DELETE FROM Hobbies WHERE id = :id");
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