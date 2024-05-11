<?php

namespace App\Entities;

class User {
    private $id;
    private $username;
    private $password;
    private $email;
    private $profile_info;
    private $profile_photo;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = htmlspecialchars($id);

        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = htmlspecialchars($username);

        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);

        return $this->email;
    }
    public function getProfileInfo()
    {
        return $this->profile_info;
    }
    public function setProfileInfo($profile_info)
    {
        $this->profile_info = htmlspecialchars($profile_info);
        return $this->profile_info;
    }
    public function getProfilePhoto()
    {
        return $this->profile_photo;
    }
    public function setProfilePhoto($profile_photo)
    {
        $this->profile_photo = htmlspecialchars($profile_photo);
        return $this->profile_photo;
    }
 
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = htmlspecialchars($password);
        return $this->password;
    }
}