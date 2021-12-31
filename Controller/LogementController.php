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
        $from = explode("/", $_SERVER["HTTP_REFERER"]);


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $form =  $this->formValidator->formNewLogementValidator($_POST);
            $isImageOK = $this->formValidator->imageFormValidator($_FILES);

            //Si le formulaire est valide
            if ($form["status"] === true) {
                if ($isImageOK["status"] === true) {
                    //Déplace l'image dans le dossier en application
                    move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/Images/"  . $isImageOK["newPath"]);
                } elseif ($isImageOK["status"] === false) {
                    header('Location:' . URL . "logement/add");
                    exit();
                }
                // Test d'ou vient le form => add ou edit
                if ($from[4] === "add") {

                    // INSERTION DES DONNEES EN BASE
                    $response = $this->logementManager->newLogement(
                        $form["valid_values"]['title'],
                        $form["valid_values"]["adresse"],
                        $form["valid_values"]["ville"],
                        $form["valid_values"]["cp"],
                        $form["valid_values"]["surface"],
                        $form["valid_values"]["prix"],
                        $isImageOK["newPath"],
                        $form["valid_values"]["type"],
                        $form["valid_values"]["description"]
                    );
                } elseif ($from[4] === "edit") {
                    //UPDATE BASE DE DONNEE
                    $response = $this->logementManager->editLogementDB(
                        $_POST["id-logement"],
                        $form["valid_values"]['title'],
                        $form["valid_values"]["adresse"],
                        $form["valid_values"]["ville"],
                        $form["valid_values"]["cp"],
                        $form["valid_values"]["surface"],
                        $form["valid_values"]["prix"],
                        $isImageOK["newPath"],
                        $form["valid_values"]["type"],
                        $form["valid_values"]["description"]
                    );
                }
            } elseif ($form["status"] === false) {
                // $this->utils->dd($form); 
                //$_SESSION["invalid_form"] = $form; 
                header('Location:' . URL . "logement");
                exit();
            }

            if ($response === true) {
                header('Location:' . URL . "logement");
                exit();
            } else {
                header('Location:' . URL . "logement/add");
                exit();
            }
        } else {
            // si le formulaire est vide
            header('Location:' . URL . "logement/add");
            exit();
        }
    }

    public function editLogement($id)
    {
        $logement = $this->logementManager->getLogementById($id);
        require_once('View/edit.logement.view.php');
    }

    public function deleteLogement($id)
    {
        $this->logementManager->deleteLogementBD($id);
        header("Location:" . URL . "logement");
    }
}
