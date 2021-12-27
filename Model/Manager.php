<?php

abstract class Manager {

    private static $pdo;
    private $host = "localhost";
   // private $port = "3306";
    private $name = "immobilier";
    private $user = "root";
    private $pass = "";
   

    private static function setBdd(){
        
        self::$pdo = new PDO("mysql:host=$this->host;dbname=$this->name;charset=utf8",$this->user,$this->pass);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd(){

        if(self::$pdo === null){
        self::setBdd();
        }
        return self::$pdo;
    }

}