<?php

namespace App\Controller;

use App\Core\Bootstrap;
use App\Core\Controller;
use App\Core\Model;
use App\Model\CountryModel;
use Exception;

class CountryController extends Controller
{



   public function __construct(public Bootstrap $bootstrap)
   {
      parent::__construct($this->bootstrap);
   }

   public function index()
   {
      $get = $this->bootstrap->request->getParam(); //i dati da $_GET se sono presenti


      //model
      $model = new CountryModel($this->bootstrap->pdo);
      $countries = $model->getAllElements("countries");
      //recupero gli elementi
      $countries = $this->filter($countries); //aggiungo la possibilità di filtrare in base ai parametri della URL

      $this->renderApi($countries); //mando il JSON
   }


   public function insertCountry()
   {

      $post = $this->bootstrap->request->getPost(); //prendo i dati da $_POST come key=>value
      $model = new CountryModel($this->bootstrap->pdo);

      try {
         $newCountry = $model->insert("countries", $post);
         $this->bootstrap->response->setCode(201);
         $this->renderApi($newCountry);
      } catch (Exception $e) {
         $this->renderApi(["message" => "forse il paese è già presente nella lista"]);
      }
   }

   public function deleteCountry()
   {

      //var_dump($this->getBodyParams()["id"]);
      $id = (int)$this->getVariablePath()["id"];
      $model = new CountryModel($this->bootstrap->pdo);

      try {
         $model->delete("countries", "id_country", $id);
         $this->renderApi(["message" => "eliminato paese con id:$id"]);
      } catch (Exception $e) {
         $this->bootstrap->response->setCode(404);
         $this->renderApi(["message" => "errore eliminazione"]);
      }
   }

   public function updateCountry()
   {

      $id = (int)$this->getVariablePath()["id"]; //prendo il valore della variabile della URL [:id => Number id]
      // $data = file_get_contents('php://input');

      $body = $this->bootstrap->request->getBodyRequest(); //prendo il corpo della richiesta

      $model = new CountryModel($this->bootstrap->pdo);

      try {
         if ($model->update("countries", "name", $body["name"], "id_country", $id)) //modfico paesi
            $this->renderApi(["message" => "paese modificato"]);          //mando a schermo
      } catch (Exception $e) {
         $this->bootstrap->response->setCode(400);
         $this->renderApi(["message" => "errore durante la modifica"]);
      }
   }
}
