<?php

use App\Controller\PaesiController;
use App\Controller\ViaggiController;


return [

     "get"=>[
          
          "/api/viaggi" => [ViaggiController::class, "index"],
          "/api/paesi" => [PaesiController::class, "index"]
          
     ] ,
     
     "post"=>
          [
          "/api/viaggi" => [ViaggiController::class, "createTravel"],
          "/api/paesi" => [PaesiController::class, "insertCountry"],
          "/api/viaggi/settings" => [ViaggiController::class, "updateTravel"],
          "/api/paesi/settings" => [PaesiController::class, "updateCountry"],
          "/api/viaggi/delete" => [ViaggiController::class, "deleteTravel"],
          "/api/paesi/delete" => [PaesiController::class, "deleteCountry"]
          ]

]





?>