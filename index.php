<?php
define("URL" , str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ));

require_once "Controller/LogementController.php";
require_once "Controller/HomeController.php"; 

$logementController = new LogementController;
$homeController = new HomeController; 

if(empty($_GET['page'])){
    require_once "view/home.view.php";
}else {
    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL );
    switch($url[0]){
        case "accueil" :
        //$homeController->homePage(); 
        break;
        case "logement" : 
            if(empty($url[1])){
              $logementController->displayLogements(); 
            } else if($url[1] === "add"){
                $logementController->newLogementForm(); 
            } else if($url[1] === "formValidator"){
                $logementController->newLogementValidation();
            } else if($url[1] === "edit"){
               $logementController->editLogement($url[2]); 
            } else if($url[1] === "editvalid"){
                $logementController->newLogementValidation();
            }
            else if($url[1] === "delete"){
                $logementController->deleteLogement($url[2]);
            } 
        break;
    }
}