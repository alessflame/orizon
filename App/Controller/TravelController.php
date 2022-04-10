<?php

namespace App\Controller;

use App\Core\Bootstrap;
use App\Core\Controller;
use App\Model\TravelModel;
use App\Model\CountryModel;
use App\Model\TravelCountryModel;
use \Exception;

class TravelController extends Controller
{

   public function __construct(public Bootstrap $bootstrap)
   {
      parent::__construct($this->bootstrap);
   }


   public function index()
   {

      $model = new TravelModel($this->bootstrap->pdo);

      $travels = $model->getAllElements("travels");
      $travelsCountries = new TravelCountryModel($this->bootstrap->pdo);
      //recupero i viaggi
      $allTravels = [];
      foreach ($travels as $travel) {
         $id = $travel["id_travel"];
         $travel["countries"] = $travelsCountries->getCountriesFrom_IDtravel($id);
         //utilizzo l'inner join presente in una funzione nella classe TravelCountryModel per
         //recuperare i paesi abbinati ad un viaggio 
         array_push($allTravels, $travel);
      }

      $allTravels = $this->filter($allTravels);
      $this->renderApi($allTravels);
   }

   public function insertTravel()
   {

      // [
      //     "name"=> "travelProva" , 
      //     "places"=> 150,    
      //     "countries"=>[     
      //     "Italy" ,
      //        "Panama",
      //        "SudCorea"]
      //     ];



      $post = $this->bootstrap->request->getPost(); //ricevo i dati
      if (!$post) $post = json_decode(json_encode($this->bootstrap->request->getBodyRequest()), true);
      //se i dati non vengono da un post , li avrò ricevuti come json o come x-www-form-urlencoded

      try {
         $model = new TravelModel($this->bootstrap->pdo);
         $idTravel = $model->insert("travels", ["name" => $post["name"], "places" => $post["places"]]);
         //inserisco un viaggio
         (new TravelCountryModel($this->bootstrap->pdo))->insert_Travel_Country($idTravel, $post["countries"], $this->bootstrap->pdo);
         //la lista dei paesi di un viaggio viane gestita dal TravelCountryModel che inserisce l'associazione viaggio-paesi
         $this->bootstrap->response->setCode(201);
         $this->renderApi(["message" => "inserito nuovo viaggio"]);
      } catch (Exception $e) {
         $this->bootstrap->response->setCode(404);
         $this->renderApi(["message" => "errore"]);
      }
   }


   public function deleteTravel()
   {

      $travelDeletedID = (int)$this->getVariablePath()["id"];

      $model = new TravelModel($this->bootstrap->pdo);
      $travelsCountries = new TravelCountryModel($this->bootstrap->pdo);

      try {
         $model->delete("travels", "id_travel", $travelDeletedID); //elimino il viaggio
         $travelsCountries->delete("travels_countries", "id_travel", $travelDeletedID);
         //elimino le associazioni di un determinato viaggio
         $this->bootstrap->response->setCode(200);
         $this->renderApi(["message" => "viaggio eliminato con successo"]);
      } catch (Exception $e) {
         $this->bootstrap->response->setCode(404);
         $this->renderApi(["message" => "errore"]);
      }
   }



   public function updateTravel()
   {
      $travelUpdatedID = (int)$this->getVariablePath()["id"];

      $data = $this->bootstrap->request->getBodyRequest();

      $model = new TravelModel($this->bootstrap->pdo);

      try {
         foreach ($data as $property => $value) {
            $model->update("travels", $property, $value, "id_travel", $travelUpdatedID);
         }

         $this->bootstrap->response->setCode(200);
         $this->renderApi(["message" => "viaggio modificato con successo"]);
      } catch (Exception $e) {
         $this->bootstrap->response->setCode(404);
         $this->renderApi(["message" => "errore durante la modifica"]);
      }
   }
}
