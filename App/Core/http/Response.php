<?php
namespace App\Core\Http;


class Response{

     private string $content="";
     private int $statusCode= 200;
     private string $contentType="";

     public function __construct(){


          }
          
          public function send(){
        header($this->contentType);
        http_response_code($this->statusCode);
        echo $this->content;

     }


         public function redirect($toUrl){
          header("location:$toUrl");
           exit;

         }


         public function setContent($content){
              $this->content= $content;
              
         }

         public function setType($type){

          $this->contentType= $type;
         }

         public function setCode($code){
          $this->statusCode= $code;
         }

     }

         ?>