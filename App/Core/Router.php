<?php

namespace App\Core;

class Router {
    public function routes(){
        // test de la superglobale $_GET['controller']
        // ajout du premier index de $_GET dans la variable $controller, ou par défaut 'home' ainsi que son namespace, plus le mot Controller
        // pour compléter le nom de la classe controller à instancier

        $controller = isset($_GET['controller']) ? ucfirst(array_shift($_GET)) : 'home';
        $controller = '\\App\\Controllers\\' .$controller. 'Controller';

        // test de la superglobale $_GET['action']
        $action = isset($_GET['action']) ? array_shift($_GET) : 'index';

        $controller = new $controller();

        if(method_exists($controller, $action)){
            // si $_GET contient des index, on exécute la méthode en passant comme argument les paramètres de $_GET ou alors on exécute la méthode sans argument
            isset($_GET) ? $controller->$action($_GET) : $controller->$action();
        } else {
            // Renvoyer le code réponse 404
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }
    }
}