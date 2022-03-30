<?php
namespace App\Core;

use App\Core\Bootstrap;

class ApiView extends View{


     
     public function __construct(public Bootstrap $bootstrap){


     }

     public function getApiContent($content){
          return json_encode($content);
     }




}










?>