<?php

require_once 'Model/LogementManager.php';
require_once 'Service/FormValidator.php'; 

class LogementController {
    private $logementManager;
    private $formValidator;

    public function __construct(){
        $this->logementManager = new LogementManager; 
        $this->logementManager->loadLogements();
        $this->formValidator = new formValidator; 
    }

    public function displayLogements(){
       
        $logements = $this->logementManager->getLogements(); 
        require_once "View/logements.view.php"; 
    }

    public function newLogementForm(){
        require_once "View/new.logement.view.php"; 
    }

    public function newLogementValidation(){
 

        if($_SERVER["REQUEST_METHOD"] == "POST"){
          $test =  $this->formValidator->formNewLogementValidator($_POST);
        }

        var_dump($test); 
 

        $path = "Images"; 
        $imageInfo = new SplFileInfo($_FILES["photo"]["name"]); 

        if(!empty($_FILES["photo"])){
            // création du fichier images s'il n'existe pas
            if(!is_dir($path)){
                echo "on est la"; 
                mkdir($path, 0777, true); 
            }
        } 

        $extensionValid = ['jpg', 'png', 'jpeg'];


        if(in_array($imageInfo->getExtension(), $extensionValid)){
 
        $temp = explode(".", $_FILES["photo"]["name"]);
        $newfilename = "Logement_" . round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/Images/"  . $newfilename);
        } else {
            echo "l extension n'est pas valide " . $imageInfo->getExtension(); 
            echo $imageInfo->getSize();
        }

       // var_dump($newfilename); 
    }
}