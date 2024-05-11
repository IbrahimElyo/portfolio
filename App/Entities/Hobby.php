<?php

namespace App\Entities;

class Hobby {
    private $id;
    private $hobby_name;
    private $description;
    private $icon;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = htmlspecialchars($id);
        
        return $this->id;
    }
    public function getHobbyName()
    {
        return $this->hobby_name;
    }
    public function setHobbyName($hobby_name)
    {
        $this->hobby_name = htmlspecialchars($hobby_name);
        return $this->hobby_name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = htmlspecialchars($description);
        return $this->description;
    }
    public function getIcon()
    {
        return $this->icon;
    }
    public function setIcon($icon)
    {
        $this->icon = htmlspecialchars($icon);
        return $this->icon;
    }

}