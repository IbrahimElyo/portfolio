<?php
namespace App\Entities;

class Presentation{
    private $id;
    private $full_name;
    private $about_me;
    private $phone_number;
    private $readme;
    private $website_url;
    private $address;

    public function getId(){

        return $this->id;
    }
    public function setId($id){

        $this->id = htmlspecialchars($id);

        return $this->id;
    }
    public function getFullName(){

        return $this->full_name;

    }
    public function setFullName($full_name){

        $this->full_name = htmlspecialchars($full_name);

        return $this->full_name;
    }
    public function getAboutMe(){

        return $this->about_me;

    }
    public function setAboutMe($about_me){

        $this->about_me = htmlspecialchars($about_me);

        return $this->about_me;
    }
    public function getPhoneNumber(){

        return $this->phone_number;
    }
    public function setPhoneNumber($phone_number){

        $this->phone_number = htmlspecialchars($phone_number);

        return $this->phone_number;
    }
    public function getReadme(){

        return $this->readme;
    }
    public function setReadme($readme){

        $this->readme = htmlspecialchars($readme);

        return $this->readme;
    }
    public function getWebSiteUrl(){

        return $this->website_url;
    }
    public function setWebSiteUrl($website_url){

        $this->website_url = htmlspecialchars($website_url);

        return $this->website_url;
    }

    public function getAddress(){

        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = htmlspecialchars($address);
        return $this->address;
    }
}