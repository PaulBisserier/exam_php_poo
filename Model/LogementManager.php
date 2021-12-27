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
}