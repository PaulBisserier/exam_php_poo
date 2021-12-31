<?php

require_once "Logement.php";
require_once "Manager.php";

class LogementManager extends Manager
{

    private $logements;

    public function addLogement($logis)
    {
        $this->logements[] = $logis;
    }

    public function getLogements()
    {
        return $this->logements;
    }

    /**
     * récupère tous les logements présents en base.
     */
    public function loadLogements()
    {
        $req  = $this->getBdd()->prepare("SELECT * FROM logement");
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($results as $result) {
            $data = new Logement(
                $result['id_logement'],
                $result['titre'],
                $result['adresse'],
                $result['ville'],
                $result['cp'],
                $result['surface'],
                $result['prix'],
                $result['photo'],
                $result['type'],
                $result['description']
            );
            $this->addLogement($data);
        }
    }

    public function newLogement($titre, $adresse, $ville, $cp, $surface, $prix, $photo, $type, $description)
    {
        $req = "INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description) 
        VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":titre", $titre, PDO::PARAM_STR);
        $statement->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $statement->bindValue(":ville", $ville, PDO::PARAM_STR);
        $statement->bindValue(":cp", $cp, PDO::PARAM_STR);
        $statement->bindValue(":surface", $surface, PDO::PARAM_INT);
        $statement->bindValue(":prix", $prix, PDO::PARAM_INT);
        $statement->bindValue(":photo", $photo, PDO::PARAM_STR);
        $statement->bindValue(":type", $type, PDO::PARAM_STR);
        $statement->bindValue(":description", $description, PDO::PARAM_STR);
        $result = $statement->execute();
        $statement->closeCursor();

        return $result;
    }

    public function getLogementById($id)
    {
        foreach ($this->logements as $logement) {
            if ($logement->getId_logement() == $id) {
                return $logement;
            }
        }
    }

    public function editLogementDB($id, $titre, $adresse, $ville, $cp, $surface, $prix, $photo, $type, $description)
    {
        $req = "UPDATE logement SET titre = :titre, adresse = :adresse, ville = :ville, cp = :cp, surface = :surface, prix = :prix, photo = :photo,
        type = :type, description = :description
        WHERE id_logement = :id_logement";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":id_logement", $id, PDO::PARAM_INT);
        $statement->bindValue(":titre", $titre, PDO::PARAM_STR);
        $statement->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $statement->bindValue(":ville", $ville, PDO::PARAM_STR);
        $statement->bindValue(":cp", $cp, PDO::PARAM_STR);
        $statement->bindValue(":surface", $surface, PDO::PARAM_INT);
        $statement->bindValue(":prix", $prix, PDO::PARAM_INT);
        $statement->bindValue(":photo", $photo, PDO::PARAM_STR);
        $statement->bindValue(":type", $type, PDO::PARAM_STR);
        $statement->bindValue(":description", $description, PDO::PARAM_STR);
        $result = $statement->execute();
        $statement->closeCursor();

        if ($result) {
           return $result;
        }
    }

    public function deleteLogementBD($id){
        $req = "DELETE FROM logement WHERE id_logement = :id_logement";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":id_logement", $id, PDO::PARAM_INT);
        $result = $statement->execute();
        $statement->closeCursor();

        if($result ){
          $game = $this->getLogementById($id);    
          unset($game);
        }
    }
}
