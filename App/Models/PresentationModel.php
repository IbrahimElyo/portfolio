<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Presentation;

class PresentationModel extends DbConnect {

    // Affichage total
    public function findAll()
    {
        $this->request = "SELECT * FROM Presentation";
        $result = $this->connexion->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }

    // Affichage unique
    public function find(int $id)
    {
        $this->request = $this->connexion->prepare("SELECT * FROM Presentation WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        $presentation = $this->request->fetch();
        return $presentation;
    }
    // Création
    public function create(Presentation $presentation){
        $this->request = $this->connexion->prepare("INSERT INTO Presentation VALUES (NULL, :full_name, :about_me, :phone_number, :readme, :website_url, :address)");
        $this->request->bindValue(":full_name", $presentation->getFullName());
        $this->request->bindValue(":about_me", $presentation->getAboutMe());
        $this->request->bindValue(":phone_number", $presentation->getPhoneNumber());
        $this->request->bindValue(":readme", $presentation->getReadme());
        $this->request->bindValue(":website_url", $presentation->getWebSiteUrl());
        $this->request->bindValue(":address", $presentation->getAddress());
        $this->executeTryCatch();
    }

        //Mise à jour
        public function update(int $id, Presentation $presentation) {
            $updates = [];
            $data = [];
        
            if ($presentation->getFullName() !== null) {
                $updates[] = "full_name = :full_name";
                $data['full_name'] = $presentation->getFullName();
            }
            if ($presentation->getAboutMe() !== null) {
                $updates[] = "about_me = :about_me";
                $data['about_me'] = $presentation->getAboutMe();
            }
            if ($presentation->getPhoneNumber() !== null) {
                $updates[] = "phone_number = :phone_number";
                $data['phone_number'] = $presentation->getPhoneNumber();
            }
            if ($presentation->getReadme() !== null) {
                $updates[] = "readme = :readme";
                $data['readme'] = $presentation->getReadme();
            }
            if ($presentation->getWebSiteUrl() !== null) {
                $updates[] = "website_url = :website_url";
                $data['website_url'] = $presentation->getWebSiteUrl();
            }
            if ($presentation->getAddress() !== null) {
                $updates[] = "address = :address";
                $data['address'] = $presentation->getAddress();
            }
            if (!empty($updates)) {
                $sql = "UPDATE Presentation SET " . join(", ", $updates) . " WHERE id = :id";
                $data['id'] = $id;
        
                $this->request = $this->connexion->prepare($sql);
                foreach ($data as $key => $value) {
                    $this->request->bindValue($key, $value);
                }
                $this->executeTryCatch();
            }
        }
        

        //Suppression
        public function delete(int $id){
            $this->request = $this->connexion->prepare("DELETE FROM Presentation WHERE id = :id");
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