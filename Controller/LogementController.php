<?php

require_once 'Model/LogementManager.php';
require_once 'Service/FormValidator.php';
require_once 'Service/Utils.php';

class LogementController
{
    private $logementManager;
    private $formValidator;
    private $utils;

    public function __construct()
    {
        $this->logementManager = new LogementManager;
        $this->logementManager->loadLogements();
        $this->formValidator = new formValidator;
        $this->utils = new Utils;
    }

    public function displayLogements()
    {

        $logements = $this->logementManager->getLogements();
        require_once "View/logements.view.php";
    }

    public function newLogementForm()
    {
        require_once "View/new.logement.view.php";
    }

    public function newLogementValidation()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form =  $this->formValidator->formNewLogementValidator($_POST);
            //Si le formulaire est valide
            if ($form["status"] === true) {
                // controle de la présence d'une photo
                if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
                    // controle de la photo
                    $isImageOK = $this->formValidator->imageFormValidator($_FILES);

                    if ($isImageOK["status"] === true) {
                        
                        // création du dossier
                        $this->utils->createDirectory();
                        //on donne à l'image son chemin
                        $imagePath = $isImageOK["newnamefile"]; 
                        //Déplace l'image dans le dossier en application
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/Images/"  . $isImageOK["newnamefile"]);
                    } elseif ($isImageOK["status"] === false) {
                        echo "<pre>";
                        // var_dump($isImageOK);
                        echo "</pre>";
                    }
                } else{ 
                    $imagePath = null; 
                }
                 // INSERTION DES DONNEES EN BASE
                 $isInsert = $this->logementManager->newLogement(
                    $form["valid_values"]['title'],
                    $form["valid_values"]["adresse"],
                    $form["valid_values"]["ville"],
                    $form["valid_values"]["cp"],
                    $form["valid_values"]["surface"],
                    $form["valid_values"]["prix"],
                    $imagePath,
                    $form["valid_values"]["type"],
                    $form["valid_values"]["description"]
                );
            } elseif ($form["status"] === false) {
                //$_SESSION["invalid_form"] = $form; 
                header('Location:' . URL . "logement");
            }

            if($isInsert === true) {
              header('Location:' . URL . "logement"); 
            } else{
                header('Location:' . URL . "logement/add"); 
            }
        } else {
            // si le formulaire est vide
            header('Location:' . URL . "logement/add"); 
        }
    }

    public function editLogement($id){
        $logement = $this->logementManager->getLogementById($id);
        require_once('View/edit.logement.view.php'); 
    }
}
