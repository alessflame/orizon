<?php

 require_once __DIR__."/vendor/autoload.php";

use App\Core\Bootstrap;
use App\Core\Config;
 


 Config::setEnv(__DIR__."/.env");

 $routes= Config::getFile(__DIR__."/config/routes.php"); //array che contiene i routes -> utilizzo la funzione statica getFile

(new Bootstrap($routes))->run();




?>