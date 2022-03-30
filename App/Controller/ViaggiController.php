<?php

namespace App\Controller;

use App\Core\Bootstrap;
use App\Core\Controller;
use App\Model\ViaggiModel;

class ViaggiController extends Controller
{

   public function __construct(public Bootstrap $bootstrap)
   {
      parent::__construct($this->bootstrap);
   }


   public function index()
   {

      $viaggiModel = new ViaggiModel($this->bootstrap->pdo);

      $get = $this->bootstrap->request->getParam();

      $travels = $viaggiModel->getAllElements("viaggi");

      $items = [];

      foreach ($travels as $travel) {
         $travel["paesi"] = $viaggiModel->getElementsFromProperty("paesi", "id_viaggio", $travel["id_viaggio"]);
         array_push($items, $travel);
      }

      $get = $this->bootstrap->request->getParam();

      if ($get) $items = $this->filter($items);

      $this->renderApi($items);
   }

   public function createTravel()
   {

      $viaggiModel = new ViaggiModel($this->bootstrap->pdo);
      $post = $this->bootstrap->request->getPost();

      $postTravel = [
         "nome" => $post["nome"],
         "n_posti" => $post["n_posti"],
         "n_posti_occupati" => $post["n_posti_occupati"]
      ];

      $last_id = $viaggiModel->insert("viaggi", $postTravel);


      foreach ($post["nome_paese"] as $nomePaese) {
         $postCountry = [
            "nome" => $nomePaese,
            "id_viaggio" => $last_id
         ];
         if ($viaggiModel->insert("paesi", $postCountry))
            $this->render("Viaggio creato con successo");
      }
   }


   public function updateTravel()
   {

      $viaggiModel = new ViaggiModel($this->bootstrap->pdo);

      $post = $this->bootstrap->request->getPost();

      if ($viaggiModel->update("viaggi", $post["prop"], $post["value"], $post["where_prop"], $post["where_value"]))
         $this->render("Viaggio modificato con successo");
   }


   public function deleteTravel()
   {
      $viaggiModel = new ViaggiModel($this->bootstrap->pdo);

      $post = $this->bootstrap->request->getPost();

      if ($viaggiModel->delete("viaggi", $post["prop"], $post["value"])) {

         $this->render("eliminato con successo");
      }
   }
}
