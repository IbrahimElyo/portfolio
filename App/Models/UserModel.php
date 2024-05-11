<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\User;

class UserModel extends DbConnect {

    public function findByEmail($email) {
        $this->request = $this->connexion->prepare("SELECT * FROM Users WHERE email = :email");
        $this->request->bindValue(":email", $email);
        $this->request->execute();
        return $this->request->fetch();
    }
    public function findByUsername($username) {
        $this->request = $this->connexion->prepare("SELECT * FROM users WHERE username = :username");
        $this->request->bindValue(":username", $username);
        $this->request->execute();
        return $this->request->fetch();
    }    

    // Affichage total
    public function findAll(){
        $this->request = "SELECT * FROM Users";
        $result = $this->connexion->query($this->request);
        $list = $result->fetchAll(); 
        return $list;
    }

    public function find(int $id) {
        $this->request = $this->connexion->prepare("SELECT * FROM Users WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->request->execute();
        $user = $this->request->fetch();
        return $user;
    }

    /* Création */
    public function create(User $user){
        // Hachage du mot de passe
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        
        $this->request = $this->connexion->prepare("INSERT INTO Users (username, password, email, profile_info, profile_photo) VALUES (:username, :password, :email, :profile_info, :profile_photo)");
        $this->request->bindValue(":username", $user->getUserName());
        $this->request->bindValue(":password", $hashedPassword); // Utilisez le mot de passe haché
        $this->request->bindValue(":email", $user->getEmail());
        $this->request->bindValue(":profile_info", $user->getProfileInfo());
        $this->request->bindValue(":profile_photo", $user->getProfilePhoto());
        $this->executeTryCatch();
    }
    
    /* Mise à jour */
    public function update(int $id, User $user){
        // Hachage du mot de passe
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        
        $this->request = $this->connexion->prepare("UPDATE Users SET username = :username, password = :password, email = :email, profile_info = :profile_info, profile_photo = :profile_photo WHERE id = :id");
        $this->request->bindValue(":id", $id);
        $this->request->bindValue(":username", $user->getUserName());
        $this->request->bindValue(":password", $hashedPassword); // Utilisez le mot de passe haché
        $this->request->bindValue(":email", $user->getEmail());
        $this->request->bindValue(":profile_info", $user->getProfileInfo());
        $this->request->bindValue(":profile_photo", $user->getProfilePhoto());
        $this->executeTryCatch();
    }

    /* Suppression */
    public function delete(int $id){
        $this->request = $this->connexion->prepare("DELETE FROM Users WHERE id = :id");
        $this->request->bindParam(":id", $id);
        $this->executeTryCatch();
    }

    private function executeTryCatch() {
        try {
            $this->request->execute();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        // Ferme le curseur, permettant à la requête d'être de nouveau exécutée
        $this->request->closeCursor();
    }
}
