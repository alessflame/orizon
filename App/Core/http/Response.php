<?php
namespace App\Core\Http;


class Response{

     private string $content=""; //proprietà della classe che prende in gestione il contenuto da mandare in risposta
     private int $statusCode= 200; //statusCode della risposta
     private string $contentType=""; //Content Type per la Header-> per gestire il json o html

     public function __construct(){


          }
          
          public function send(){
        header($this->contentType);
        http_response_code($this->statusCode);
        echo $this->content;
        //manda la risposta settando la header("content-type") e lo status code
     }


         public function redirect($toUrl){
              //eventuali reindirizzamenti
          header("location:$toUrl");
           exit;

         }


         public function setContent($content){
              //setta il contenuto da mandare
              $this->content= $content;
              
         }

         public function setType($type){
         //settare il content type della header per la risposta
          $this->contentType= $type;
         }

         public function setCode($code){
              //settare il codice di stato della risposta
          $this->statusCode= $code;
         }

     }

         ?>