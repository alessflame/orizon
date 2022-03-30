<?php

namespace App\Controller;

use App\Core\Bootstrap;
use App\Core\Controller;
use App\Core\Model;
use App\Model\PaesiModel;

class PaesiController extends Controller
{

   public function __construct(public Bootstrap $bootstrap)
   {
      parent::__construct($this->bootstrap);
   }


   public function index()
   {

      $paesiModel = new PaesiModel($this->bootstrap->pdo);

      $items = $paesiModel->selectDistinct("paesi", "nome");
     
      $get= $this->bootstrap->request->getParam();

      if($get) $items = $this->filter($items);

      $this->renderApi($items);
   }

   




   public function insertCountry()
   {

      $paesiModel = new PaesiModel($this->bootstrap->pdo);
      $post = $this->bootstrap->request->getPost();

      $items  = [
         "nome" => $post["nome"],
         "id_viaggio" => $post["id_viaggio"]
      ];

      if ($paesiModel->insert("paesi", $items)) $this->render("inserito con successo");
   }


   public function updateCountry()
   {

      $paesiModel = new PaesiModel($this->bootstrap->pdo);
      $post = $this->bootstrap->request->getPost();

      if($paesiModel->update("paesi", "nome", $post["value"], "id_paese", $post["id"])){

         $this->render("Paese modificato con successo");
      };


   }

   public function deleteCountry(){
      $paesiModel= new PaesiModel($this->bootstrap->pdo);

      $post= $this->bootstrap->request->getPost();

      if($paesiModel->delete("paesi", $post["prop"], $post["value"])){
      
         $this->render("eliminato con successo");

      }
      
   }


}
