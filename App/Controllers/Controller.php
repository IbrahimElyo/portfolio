<?php

namespace App\Controllers;

abstract class Controller {

    public function render(string $path, array $data = []) {
        ob_start();

        // Extraction des données récupérées sous forme de variables
        extract($data);

        // Création du chemin et inclusion du fichier de la vue souhaitée
        include dirname(__DIR__) . '/Views/' . $path . '.php';

        // Je vide le buffer dans la variable $content
        $content = ob_get_clean();

        // Vérification pour voir si la requête est une requête AJAX
        if ($this->isAjax()) {
            echo $content;
        } else {
            include dirname(__DIR__).'/Views/base.php';
        }
    }

    // Méthode pour vérifier si la requête est une requête AJAX
    private function isAjax(): bool {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}
