<?php

namespace App\Entities;

class Skill {
    private $id;
    private $skill_name;
    private $skill_description;
    private $skill_icon;
    private $skill_url;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = htmlspecialchars($id);

        return $this->id;
    }
    public function getSkillName()
    {
        return $this->skill_name;
    }
    public function setSkillName($skill_name)
    {
        $this->skill_name = htmlspecialchars($skill_name);
    }
    public function getSkillDescription()
    {
        return $this->skill_description;
    }
    public function setSkillDescription($skill_description)
    {
        $this->skill_description = htmlspecialchars($skill_description);
    }
    public function getSkillIcon()
    {
        return $this->skill_icon;
    }
    public function setSkillIcon($skill_icon)
    {
        $this->skill_icon = htmlspecialchars($skill_icon);
    }
    public function getSkillUrl()
    {
        return $this->skill_url;
    }
    public function setSkillUrl($skill_url)
    {
        $this->skill_url = htmlspecialchars($skill_url);
    }
    
}