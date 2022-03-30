<?php
namespace App\Core\http;

class Request{

     private string $pathURL;
     private string $method;


     public function __construct()
     {
          $this->path= $this->getRequestPath();
          $this->method= $this->getMethod();
     }

  
     public function getPost(){
          //eventuali operzioni preventive
          return $_POST ?? [];
     }

     public function getParam(){
          return $_GET ?? [];
     }


     public function getMethod(){

          return strtolower($_SERVER["REQUEST_METHOD"]);

     }


     public function getRequestPath(){

          return $_SERVER["REQUEST_URI"];

     }



}










?>