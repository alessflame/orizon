<?php
namespace App\Core;

class Database{

     public \PDO $pdo; 

     public function __construct()
     {
          $dbhost= getenv('DB_HOST');
          $dbuser= getenv('DB_USER');
          $dbpwd=  getenv('DB_PWD');
          $dbname= getenv('DB_NAME');
          //utilizzo le variabili d'ambiente


          $dsn= "mysql:host=".$dbhost.";dbname=".$dbname.";
          charset=utf8";   //stringa di connessione per il \PDO

          $this->pdo= new \PDO($dsn, $dbuser , $dbpwd,[
               //settaggio delle opzioni PDO
                \PDO::ATTR_ERRMODE =>\PDO::ERRMODE_EXCEPTION,//gestione delle eccezioni
               \PDO::ATTR_EMULATE_PREPARES => false//dà una sicurezza in più ai prepares
          ]);

     }

}














?>