<?php 

namespace App\Controllers;

use App\Models\PresentationModel;

class HomeController extends Controller {
    public function index()
    {
        $presentation = new PresentationModel();

        $listPresentation = $presentation->findAll();

        $this->render('home/index', ["elementPresentation" => $listPresentation]);
    }

}