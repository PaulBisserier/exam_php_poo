<?php
require_once 'Model/LogementManager.php';

class HomeController
{

    private $logementManager;

    public function __construct()
    {
        $this->logementManager = new LogementManager;
        $this->logementManager->loadLogements();
    }

    public function homePage()
    {
        
        $lastLogements = $this->logementManager->getLastLogements(); 
        require_once("View/home.view.php"); 
    }
}
