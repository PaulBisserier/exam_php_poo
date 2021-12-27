<?php

require_once 'Model/LogementManager.php';

class LogementController {
    private $logementManager; 

    public function __construct(){
        $this->logementManager = new LogementManager; 
        $this->logementManager->loadLogements(); 
    }

    public function displayLogements(){
       
        $logements = $this->logementManager->getLogements(); 
        require_once "View/logements.view.php"; 
    }
}