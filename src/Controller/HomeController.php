<?php

namespace App\Controller;

use App\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function __construct() {}

    /**
     * Méthode pour afficher la page d'accueil
     * @return mixed Retourne le template
     */
    public function index(): mixed
    {

        return $this->render("home", "accueil");
    }
}
