<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;
use App\Entity\Game;

class GameRepository {
    //Attribut
    private \PDO $connect;
    private ConsoleRepository $consoleRepository;

    //Constructeur
    public function __construct() {
        //Injection des dependances
        $this->connect = (new Mysql)->connectBDD();
        $this->consoleRepository = new ConsoleRepository();
    }

    //Méthodes

    /**
     * Méthode qui ajoute une jeu (Game) en BDD
     * @return void
     * @throws \Exception Erreurs SQL
     */
    public function saveGame(Game $game): string {
        try {
            //1 Ecrire la requête
            $sql = "INSERT INTO video_game(title, `type`, publish_at, id_console) VALUE(?,?,?,?)";
            //2 Préparer la requête
            $req = $this->connect->prepare($sql);
            //3 Assigner les paramètres
            $req->bindValue(1, $game->getTitle(), \PDO::PARAM_STR);
            $req->bindValue(2, $game->getType(), \PDO::PARAM_STR);
            $req->bindValue(3, $game->getPublishAt(), \PDO::PARAM_STR);
            $req->bindValue(4, $game->getConsole()->getId(), \PDO::PARAM_STR);
            //4 Exécuter la requête
            $req->execute();
            //5 Récupérer ID de la Task
            $id = $this->connect->lastInsertId();
            //6 Setter Id à la Task
            $game->setId($id);
            return "Le Jeu ".$game->getTitle()." a bien été ajouté !";
        } catch (\PDOException $e) {
            return "Une erreur s'est produite !";
        }
    }
    
    /**
     * Méthode qui retourne la liste des jeux (Game)
     * @return array<Game> Retourne le tableau des jeux (Game)
     * @throws \Exception Erreurs SQL
     */
    public function findAllGames(): array {
        try {
            //1 Ecrire la requête
            $sql = "SELECT vg.id, vg.title, vg.type, vg.publish_at, vg.id_console FROM video_game AS vg";
            //2 Préparer la requête
            $req = $this->connect->prepare($sql);
            //3 Exécuter la requête
            $req->execute();
            //4 Récupérer la réponse (tableau indexé contenant des tableaux associatifs)
            $games = $req->fetchAll(\PDO::FETCH_ASSOC);
            //5 tableau vide (qui va contenir les objets Category)
            $arrayGames = [];
            //6 Parcours la réponse FetchAll
            foreach ($games as $game) {
                //7 hydrater le tableau asso en objet Category
                $arrayGames[] = $this->hydrateGame($game); 
            }
        } catch(\PDOException $e) {}
        return $arrayGames;
    }

    /**
     * Méthode pour convertir une row SQL (FETCH_ASSOC) en Entity Game
     * @param array $game Tableau associatif
     * @return Task Entity Game
     */
    private function hydrateGame(array $row): Game
    {
        //1 Création de l'objet Console
        $cons = $this->consoleRepository->findConsoleById($row["id_console"]);
        $console = new Console($cons["name"], $cons["manufacturer"]);
        $console->setId($cons["id"]);

        //2 Création de l'objet Game
        $entityGame = new Game(
            $row["title"],
            $row["type"],
            $row["publish_at"],
            $console
        );

        //3 Set de l'Id Game
        $entityGame->setId($row["id"]);
        

        return $entityGame;
    }
}
