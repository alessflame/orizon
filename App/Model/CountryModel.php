<?php
namespace App\Model;

use App\Core\Model;

class CountryModel extends Model{
     public string $name;

     public function __construct(public \PDO $pdo)
     {
          parent::__construct($this->pdo);
     }


}















?>