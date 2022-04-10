<?php
namespace App\Core\http;

use App\Core\Bootstrap;

class Router{
    
     public string $variablePath;

     public function __construct(public Bootstrap $bootstrap)
     {
    
     }


     public function getRoute(){
          //prendo la richiesta cercandola nell'array "routes" che contiene i valori dell'instradamento
          $path =  $this->bootstrap->request->getPath();
          $method = $this->bootstrap->request->getMethod();
          $this->setVariablePath($path);

          $newPath= $this->searchParamGET($path);
          
          return $this->bootstrap->routes[$method][$newPath];
     }


     public function resolve(){
          //risolvo l'instradamento creando un istanza del controller presente nel "route" corrispondente
          $controllerInfo = $this->getRoute();

          $controller = $controllerInfo[0];
          $controllerMethod= $controllerInfo[1];

          $instanceController= new $controller($this->bootstrap);
          //invoco il metodo del controller abbinato, presente nel "route" allo posizione route[1]
          call_user_func_array([$instanceController, $controllerMethod], []);
          
     }

     public function searchParamGET($path){//cerca i parametri GET preceduti da "?" nella nella URL
          if(strtolower($this->bootstrap->request->getMethod()=="get")){
        if(strpos($path, '?') !== false) {
               $param= explode("?", $path);
               $path= $param[0];
              
           }} return $path;
          }




     public function setVariablePath($path){
     
          //se ":" è presente nel route 
          if(strpos($path, ":") !== false){
          $parametri= explode("/:", $path);
            
          $path= $parametri[0];
            
          $this->variablePath= $parametri[1]; //setto la variablePath ovvero la stringa ":id" ":name" eccetera 
          //ovviamente senza :
           }
          

     }


}













?>