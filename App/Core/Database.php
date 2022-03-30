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


          $dsn= "mysql:host=".$dbhost.";dbname=".$dbname.";
          charset=utf8";

          $this->pdo= new \PDO($dsn, $dbuser , $dbpwd,[
                \PDO::ATTR_ERRMODE =>\PDO::ERRMODE_EXCEPTION,
               \PDO::ATTR_EMULATE_PREPARES => false
          ]);

     }

}














?>