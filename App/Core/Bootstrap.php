<?php 

namespace App\Core;

use App\Core\http\Request;
use App\Core\http\Response;
use App\Core\http\Router;
use App\Core\View;
use App\Core\Database;
use Exception;

class Bootstrap{
    
     public Request $request;
     public Response $response;
     public Router $router;
     public View $view;
     public ApiView $apiView;
     public \PDO $pdo;


     public function __construct(public array $routes)
     {
          $this->request= new Request();
          $this->response= new Response();
          $this->router= new Router($this);
          $this->view = new View($this);
          $this->apiView= new ApiView($this);
          $this->connection();
          
         

     }


     public function run(){
     
          $this->router->resolve();
        


          $this->response->send();

     }


     public function connection(){
   
          try{
          $this->pdo= (new Database())->pdo;
          }catch(\PDOException $e){
          echo $e->getMessage();
          }
        


     }



}





?>