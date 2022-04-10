<?php
namespace App\Core;

use App\Core\Bootstrap;
use App\Core\http\Router;

class Controller{

   



     public function __construct(public Bootstrap $bootstrap)
     {
      
     }


   //   public function render($content, $type=""){
         
   //      $contentJSON= $this->bootstrap->view->getContent($content);
   //       $this->bootstrap->response->setContent($contentJSON);

   //   }

     public function renderApi($content, $type="Content-type:application/json"){
         //setta la risposta
          $contentJSON= $this->bootstrap->view->getContentApi($content);
          $this->bootstrap->response->setType($type);         
           $this->bootstrap->response->setContent($contentJSON);
  
     }


     public function filter($array){
          //filtraggio dei parametri get
          $get= $this->bootstrap->request->getParam();
         //  var_dump($get);
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


        public function getVariablePath(){
           //ritorna la variabili della url per le richieste PATCH e DELETE :id=> value
           
        return[
           $this->bootstrap->router->variablePath => $this->bootstrap->request->getVariableValue()
        ];
        }
    
}
