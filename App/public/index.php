<?php
ini_set('display_errors', E_ALL);
ini_set('display_startup_errors', E_ALL);
error_reporting(E_ALL);

session_start();
// Gestion de la langue
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
} elseif (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en_US'; // Langue par défaut
}
// importation des namespaces de l'autoloader et du router
use App\Autoloader;
use App\Core\Router;
use App\Core\Translation;

// J'inclus l'autoloader
include "../Autoloader.php" ;
Autoloader::register();

Translation::load($_SESSION['lang']);

// Instanciation du routeur
$route = new Router();

// Lancement de l'application
$route->routes();

