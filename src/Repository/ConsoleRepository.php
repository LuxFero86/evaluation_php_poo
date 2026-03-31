<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;

class ConsoleRepository {
    //Attribut
    private \PDO $connect;

    //Constructeur
    public function __construct() {
        //Injection des dependances
        $this->connect = (new Mysql)->connectBDD();
    }

    //Méthodes
    /**
     * Méthode qui cherche une console
     * @return Console Retourne un objet Console
     * @throws \Exception Erreurs SQL
     */
    public function findConsoleById($id): array {
        try {
            //1 Ecrire la requête
            $sql = "SELECT c.id, c.name, c.manufacturer FROM console AS c WHERE c.id = ?";
            //2 Préparer la requête
            $req = $this->connect->prepare($sql);
            //3 Assigner le paramètre
            $req->bindParam(1, $id, \PDO::PARAM_STR);
            //4 Exécuter la requête
            $req->execute();
            //5 Récupérer la réponse (tableau indexé contenant des tableaux associatifs)
            $console = $req->fetch(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }

        return $console;
    }

    //Méthodes
    /**
     * Méthode qui retourne la liste des consoles (Console)
     * @return array<Console> Retourne le tableau des consoles (Console)
     * @throws \Exception Erreurs SQL
     */
    public function findAllConsoles(): array {
        try {
            //1 Ecrire la requête
            $sql = "SELECT c.id, c.name, c.manufacturer FROM console AS c";
            //2 Préparer la requête
            $req = $this->connect->prepare($sql);
            //3 Exécuter la requête
            $req->execute();
            //4 Récupérer la réponse (tableau indexé contenant des tableaux associatifs)
            $consoles = $req->fetchAll(\PDO::FETCH_ASSOC);
            //5 tableau vide (qui va contenir les objets Category)
            $arrayConsoles = [];
            //6 Parcours la réponse FetchAll
            foreach ($consoles as $console) {
                //7 hydrater le tableau asso en objet Category
                $arrayConsoles[] = $this->hydrateConsole($console); 
            }
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }

        return $arrayConsoles;
    }

    /**
     * Méthode pour hydrater un tableau associatif en objet Console
     * @param array $row ligne d'enregistrement (Tableau associatif)
     * @return Category retourne un objet Console
     */
    public function hydrateConsole(array $row): Console
    {
        $cons = new Console($row["name"], $row["manufacturer"]);
        $cons->setId($row["id"]);
        return $cons;
    }

}
