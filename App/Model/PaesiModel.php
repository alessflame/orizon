<?php
namespace App\Model;

use App\Core\Model;

class PaesiModel extends Model{


     public function __construct(public \PDO $pdo)
     {
          parent::__construct($this->pdo);
     }


}















?>