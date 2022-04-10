<?php
namespace App\Core;

class Config{


     public static function setEnv($fileEnv){
          //settaggio delle variabili d'ambiente dal file .env
          $Envs= file($fileEnv);

          foreach($Envs as $Env){
               putenv(trim($Env));
          }

        

     }

     public static function getFile($file){
          //funzione statica per ritornare il contenuto dei file
          if(!is_file($file)){
               return false;
          }

          return include $file;

     }






}



















?>