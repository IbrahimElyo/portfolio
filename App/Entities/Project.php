<?php

namespace App\Entities;

class Project {
    private $id;
    private $title;
    private $description;
    private $project_link;
    private $project_image;
    private $creation_date;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = htmlspecialchars($id);
        
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = htmlspecialchars($title);
        
        return $this->title;
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
    public function getProjectLink()
    {
        return $this->project_link;
    }
    public function setProjectLink($project_link)
    {
        $this->project_link = htmlspecialchars($project_link);

        return $this->project_link;
    }
    public function getProjectImage()
    {
        return $this->project_image;
    }
    public function setProjectImage($project_image)
    {
        $this->project_image = htmlspecialchars($project_image);

        return $this->project_image;
    }
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    public function setCreationDate($creation_date)
    {
        $this->creation_date = htmlspecialchars($creation_date);

        return $this->creation_date;
    }

}