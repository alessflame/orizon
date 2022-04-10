<?php
namespace App\Core\http;

class Request{

     private string $path;
     private string $method;
     private string $variableValue;


     public function __construct()
     {
          $this->path= $this->getRequestPath();
          $this->method= $this->getMethod();
          $this->ifVariablePath();
     }

     public function setPath($path){
          $this->path= $path;
     }

     public function getPath(){
          //ritorna la URL 
          return $this->path;
     }
  
     public function getPost(){
          //eventuali operzioni preventive
          return $_POST ?? [];  //ritorna il Body delle richieste di tipo POST
     }

     public function getParam(){
          //ritorna i parametri delle richieste di tipo GET 
          return $_GET ?? [];
     }

     public function setVariableValue($variable){
          //setta il valore della variabile della URL se è presente
          $this->variableValue= $variable;
     
     }

     public function getVariableValue(){
          //ritorna il valore della variabile della url se è presente
         return $this->variableValue;

     }
     


     public function getMethod(){
        //info sul metodo
          return strtolower($_SERVER["REQUEST_METHOD"]);

     }


     public function getRequestPath(){
          //info sulla URL
          return $_SERVER["REQUEST_URI"];

     }

     public function getBodyRequest(){
      //utilizzo questo metodo perlopiù per le richieste patch
      $body=[];
      $headers = getallheaders(); 
      $data = file_get_contents('php://input'); 
      if(strpos($headers['Content-Type'],"application/x-www-form-urlencoded") !== false)
      {$data = parse_str($data,$body); } 
       elseif(strpos($headers['Content-Type'],'application/json') !== false)
       {  $body = json_decode($data); } 
      return $body;
     }


     public function ifVariablePath(){  //se sono presenti Variabili nella URL per le richieste delete e patch
          $newPath= "";

           if(strtolower($this->method)=="delete" || strtolower($this->method)== "patch"){
              $path = $this->getRequestPath();
              $elementsPath= explode("/", $path);
              $end= count($elementsPath)- 1;

              if(is_numeric($elementsPath[$end])){
              $this->setVariableValue($elementsPath[$end]);

              for($i=0; $i< count($elementsPath)-1; $i++){
              $newPath .= $elementsPath[$i]."/";} 
              $newPath .= ":id";
              
              $this->setPath($newPath);//aggiorno la url di richiesta
              }}
           
           }

     }













?>