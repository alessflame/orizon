<?php
namespace App\Core;

use App\Core\Bootstrap;


class View{


     public function __construct(public Bootstrap $bootstrap){


     }

     public function getContent($content){
          return $content;
     }


     public function getContentApi($content){
         
          return json_encode($content);
  
     }


}








?>