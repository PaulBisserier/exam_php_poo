<?php

require_once "Logement.php"; 
require_once "Manager.php"; 

class LogementManager extends Manager {

    private $logements;

    public function addLogement($logis){
        $this->logements[] = $logis;
    }

    public function getLogements(){
      return $this->logements; 
    }

    /**
     * récupère tous les logements présents en base.
     */
    public function loadLogements(){
        $req  = $this->getBdd()->prepare("SELECT * FROM logement");
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
    
        foreach($results as $result){
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

    public function newLogement($titre, $adresse, $ville, $cp, $surface, $prix, $photo, $type, $description){
        $req = "INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description) 
        VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":titre",$titre, PDO::PARAM_STR);
        $statement->bindValue(":adresse",$adresse, PDO::PARAM_INT);
        $statement->bindValue(":ville",$ville, PDO::PARAM_STR);
        $statement->bindValue(":cp",$cp, PDO::PARAM_STR);
        $statement->bindValue(":surface",$surface, PDO::PARAM_INT);
        $statement->bindValue(":prix",$prix, PDO::PARAM_INT);
        $statement->bindValue(":photo",$photo, PDO::PARAM_STR);
        $statement->bindValue(":type",$type, PDO::PARAM_STR);
        $statement->bindValue(":description",$description, PDO::PARAM_STR);
        $result = $statement->execute();
        $statement->closeCursor();
    }
}