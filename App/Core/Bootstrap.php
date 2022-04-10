<?php 

namespace App\Core;

use App\Core\http\Request;
use App\Core\http\Response;
use App\Core\http\Router;
use App\Core\View;
use App\Core\Database;
use \Exception;
use \PDO;


//classe che fa da "Bootstrap" ricevendo le istanze delle altre classi
class Bootstrap{
    
     public Request $request;
     public Response $response;
     public Router $router;
     public View $view;
     public \PDO $pdo;


     public function __construct(public array $routes)
     {
          $this->request= new Request();
          $this->response= new Response();
          $this->router= new Router($this);
          $this->view = new View($this);
          $this->connection();// 
          
         

     }


           public function run(){
     
          $this->router->resolve(); /*avvio l'instradamamento della richiesta 
          cercando nell'array che contiene tutti i Routes il valore appropriato 
          per far partire il giusto metodo del controller*/

        
          $this->response->send();
          /* mando al client la giusta risposta impostata dal controller*/

     }


     public function connection(){
           //il pdo della classe Bootstrap sarà uguale al pdo della classe Database
           //così posso passare l'istanza pdo direttamente dalla classe bootstrap
          try{
          $this->pdo= (new Database())->pdo;
          }catch(\PDOException $e){
          echo $e->getMessage();
          }
        


     }



}
