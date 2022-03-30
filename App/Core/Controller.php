<?php
namespace App\Core;

use App\Core\Bootstrap;

class Controller{


     public function __construct(public Bootstrap $bootstrap)
     {
          
     }


     public function render($content){
         
        $contentJSON= $this->bootstrap->view->getContent($content);
         $this->bootstrap->response->setContent($contentJSON);

     }

     public function renderApi($content, $type="Content-type:application/json"){
         
          $contentJSON= $this->bootstrap->apiView->getApiContent($content);
          $this->bootstrap->response->setType($type);         
           $this->bootstrap->response->setContent($contentJSON);
  
     }


     public function filter($array){
   
          $get= $this->bootstrap->request->getParam();
          $getKey= array_keys($get);
       
          
          $output=[];
          
              for($i=0; $i<count($array); $i++){
                 $control=true;
                 foreach($getKey as $key){
              strtolower($array[$i][$key]) === strtolower($get[$key]) ? $control *= true : $control *= false;
                 }
            
               if($control){
                 
                  array_push($output, $array[$i]);
              }
           } 
     
              return $output;
        }
    
}










?>