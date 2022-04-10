<?php
namespace App\Model;

use App\Core\Model;

class TravelModel extends Model{


     public function __construct(public \PDO $pdo)
     {
          parent::__construct($this->pdo);
     }


}















?>