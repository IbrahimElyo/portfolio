<?php

namespace App\Core;

use PDO;
use Exception;

class DbConnect {

    protected $connexion;
    protected $request;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "root";
    const BASE = "portfolio_ibrahim";
    
    public function __construct(){
        try {

            $this->connexion = new PDO('mysql:host='.self::SERVER.';dbname='.self::BASE.';charset=utf8mb4', self::USER, self::PASSWORD);

            // erreurs PDO
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            $this->connexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch(Exception $e){
            die('Erreur : '. $e->getMessage());
        }
    }
}
