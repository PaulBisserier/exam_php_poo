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

    public function newLogementForm(){
        require_once "View/new.logement.view.php"; 
    }

    public function newLogementValidation(){
        $errors = []; 
        $fields = [
            "title",
            "adresse",
            "cp",
            "surface",
            "prix",
            "description"
        ];
        $values = []; 

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            foreach ($fields as $field){
                if(empty($_POST[$field])){
                    $errors[] = $field;
                } else {
                    $values[$field] = $_POST[$field]; 
                }
            }
        }
        var_dump($errors); 

    
        //var_dump($_FILES['photo']); 
    }


}