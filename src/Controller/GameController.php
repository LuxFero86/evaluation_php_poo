<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Repository\ConsoleRepository;
use App\Repository\GameRepository;
use App\Entity\Console;
use App\Entity\Game;
use App\Utils\Tools;


class GameController extends AbstractController {
    //Attributs
    private ConsoleRepository $consoleRepository;
    private GameRepository $gameRepository;

    //Constructeur
    public function __construct() {
        //Injection des dependances
        $this->consoleRepository = new ConsoleRepository();
        $this->gameRepository = new GameRepository();
    }

    //Méthodes

    /**
     * Méthode pour ajouter un Jeu (Game)
     * @return mixed Retourne le template
     */
    public function addGame(): mixed {
        $data = [];
        //récupération de la liste des consoles
        $consoles = $this->consoleRepository->findAllConsoles();
        $data["consoles"] =  $consoles;
        //test si le formulaire est soumis
        if (isset($_POST["submit"])) {
            //1 Vérifier si les champs sont vides
            if (
                empty($_POST["title"]) ||
                empty($_POST["type"] ||
                empty($_POST["publishAt"]) ||
                empty($_POST["console"]))
            ) {
                return "Veuillez remplir tout les champs !";
            }
            //2 Nettoyer les entrées utilisateurs
            Tools::sanitize_array($_POST);

            //3 Mapper le tableau (Super globale POST)
            $addGame = $this->mapFromPost($_POST);
            
            //4 Ajout en BDD
            $data['msg'] = $this->gameRepository->saveGame($addGame);
        }
        return $this->render("add_game", "Ajouter un Jeu", $data);
    }

    /**
     * Méthode pour afficher la liste des Jeux (Game)
     * @return mixed Retourne le template
     */
    public function showAllGames(): mixed {
        $data["games"] = $this->gameRepository->findAllGames();
        return $this->render("show_all_games", "Liste des Jeux", $data);
    }

    private function mapFromPost(array $game): Game {
        //1 Créer un objet console
        $cons = $this->consoleRepository->findConsoleById($game["console"]);
        $console = new Console($cons["name"], $cons["manufacturer"]);
        $console->setId($cons["id"]);
        //2 Créer un objet game
        $addgame = new Game($game["title"], $game["type"], $game["publishAt"], $console );

        return $addgame;
    }
}
