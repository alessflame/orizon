<?php

namespace App\Model;

use App\Core\Model;

class TravelCountryModel extends Model
{
     public string $name;

     public function __construct(public \PDO $pdo)
     {
          parent::__construct($this->pdo);
     }


     public function getCountriesFrom_IDtravel($idTravel, $fetchConst = \PDO::FETCH_ASSOC)
     {   //query per visualizzare tutti i paesi associati ad un viaggio

          $query = "SELECT countries.name from countries 
          INNER JOIN travels_countries ON travels_countries.id_country= countries.id_country 
          WHERE travels_countries.id_travel=$idTravel;";

          $st = $this->pdo->prepare($query);
          $st->execute();

          return $st->fetchAll($fetchConst);
     }


     public function insert_Travel_Country($idTravel, $dataCountries, $pdo)
     {
          //funzione che gestiste l'inserimento delle righe di travels_countries
          //va in aiuto del TravelController durante l'inserimento di un nuovo "viaggio"

          $travelsCountries = new TravelCountryModel($pdo);
          foreach ($dataCountries as $country) {
          //per tutti i valori dell'array che contiene i paesi
          if ($countryValue = $travelsCountries->getElementFromProperty("countries", "name", $country)) {
          //se il paese esiste prende il suo "id" e lo aggiunge come associazione viaggio->paese nella tabella travels_countries
          $travelsCountries->insert("travels_countries", ["id_travel" => $idTravel, "id_country" => $countryValue["id_country"]]);
          } else {
          //se non esiste , lo crea e poi aggiunge l'associazione
          $id = (int)$travelsCountries->insert("countries", ["name" => $country]);
          $travelsCountries->insert("travels_countries", ["id_travel" => $idTravel, "id_country" => $id]);
               }
          }
     }
}
