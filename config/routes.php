<?php

use App\Controller\TravelController;
use App\Controller\CountryController;


return [

     "get" => 
     [
          //richieste get-> è possibile filtrare -> es.  /api/countries/?id=3&name=france
          "/api/travels" => [TravelController::class, "index"],
          "/api/countries" => [CountryController::class, "index"]
     ],

     "post" =>
     [
          "/api/travels" => [TravelController::class, "insertTravel"],
          "/api/countries" => [CountryController::class, "insertCountry"]
     ],

     "delete" =>
     [
          "/api/travels/:id" => [TravelController::class, "deleteTravel"],
          "/api/countries/:id" => [CountryController::class, "deleteCountry"]
     ],

     "patch" =>
     [
          "/api/travels/:id" => [TravelController::class, "updateTravel"],
          "/api/countries/:id" => [CountryController::class, "updateCountry"]
     ]

];
