<?php
namespace App\Core\http;

use App\Core\Bootstrap;

class Router{
    
     

     public function __construct(public Bootstrap $bootstrap)
     {
         
     }


     public function getRoute(){

          $path =  $this->bootstrap->request->getRequestPath();
          $method = $this->bootstrap->request->getMethod();
         
          $newPath= $this->searchParam($path);
           
          return $this->bootstrap->routes[$method][$newPath];
     }


     public function resolve(){

          $controllerInfo = $this->getRoute();

          $controller = $controllerInfo[0];
          $controllerMethod= $controllerInfo[1];

          $instanceController= new $controller($this->bootstrap);

          call_user_func_array([$instanceController, $controllerMethod], []);
          


     }

     public function searchParam($path){
        if(strpos($path, '?') !== false) {
               $param= explode("?", $path);
               $path= $param[0];
              
           } return $path;
          }

}













?>