<?php
namespace App\Core;

class Config{


     public static function setEnv($fileEnv){
          $Envs= file($fileEnv);

          foreach($Envs as $Env){
               putenv(trim($Env));
          }

        

     }

     public static function getFile($file){

          if(!is_file($file)){
               return false;
          }

          return include $file;

     }




}



















?>