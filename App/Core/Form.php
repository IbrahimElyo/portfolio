<?php

namespace App\Core;

class Form {
    
    //Attribut contenant le code du formulaire
    private $formElements;

    //Getter pour lire le contenu de l'attribut $formElements
    public function getFormElements(){
        return $this->formElements;
    }

    //Méthode permettant d'ajouter un ou des attributs
    private function addAttributes(array $attributes): string
    {
        $att = "";
        // Chaque attribut est parcouru
        foreach($attributes as $attribute => $value){
            $att .= " $attribute=\"$value\"";
        }
        return $att;
    }

    //Méthode permettant de générer la balise ouvrante HTML du formulaire
    public function startForm(string $action = '#', string $method = "POST", array $attributes = []): self 
    {
        //je commence le formulaire avec l'ouverture de la balise <form> et ses attributs "action" et "method"
        $this->formElements = "<form action='$action' method='$method'";
        // et ses attributs éventuels
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    //Méthode permettant d'ajouter un label
    public function addLabel(string $for, string $text, array $attributes = []): self
    {
        $this->formElements .= "<label for='$for'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        $this->formElements .= "$text</label>";
        return $this;
    }

    //Méthode permettant d'ajouter un input
    public function addInput(string $type, string $name, array $attributes = []): self
    {
        $this->formElements .= "<input type='$type' name='$name'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    //Méthode permettant d'ajouter un textarea
    public function addTextarea(string $name, string $text = '', array $attributes = []): self
    {
        $this->formElements .= "<textarea name='$name'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        $this->formElements .= "$text</textarea>";
        return $this;
    }

    //Méthode permettant d'ajouter un champ select
    public function addSelect(string $name, array $options, array $attributes = []): self
    {
        $this->formElements .= "<select name='$name'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">" ;
        // ajout des balises options
        foreach($options as $key => $value){
            $this->formElements .= "<option value='$key'>$value</option>";
        }
        $this->formElements .= "</select>";
        return $this;
    }

    public function endForm(): self {
        $this->formElements .= "</form>";
        return $this;
    }

    // Méthode permettant de tester les champs
    public static function validatePost(array $post, array $fields): bool {

        foreach($fields as $field){
            if(empty($post[$field]) || !isset($post[$field])){
                return false;
            }
        }
        return true;
    }
}