<?php

namespace App\Core;

use App\Core\Bootstrap;



class Model
{

     public function __construct(public \PDO $pdo)
     {
     }


//READ
     public function getAllElements($table, $fetchConst = \PDO::FETCH_ASSOC)
     {

          $query = "SELECT * FROM $table";
          $st = $this->pdo->prepare($query);
          $st->execute();
          return $st->fetchAll($fetchConst);
     }


     public function getElementsFromProperty($table, $prop, $value,  $fetchConst = \PDO::FETCH_ASSOC)
     {
          $query = "SELECT * from $table WHERE $prop = :$prop;";
         
           $st = $this->pdo->prepare($query);
           $st->bindValue(":$prop", $value);
           $st->execute();

           return $st->fetchAll($fetchConst);
     }

     public function selectDistinct($table, $prop, $fetchConst = \PDO::FETCH_ASSOC){

          $query= "SELECT DISTINCT $prop FROM $table ";
          
          $st = $this->pdo->prepare($query);
          $st->execute();

          return $st->fetchAll($fetchConst);

     }

     
     //Create
     public function insert($table, $values){
          $keys= array_keys($values);
          $fields= implode(",",$keys);  
     
          $placeholder = implode(",", array_map(fn($key)=> ":$key", $keys ));
     
          $query= "INSERT into $table ($fields) VALUES ($placeholder);";
     
          $stmt= $this->pdo->prepare($query);
          foreach($values as $field => $fieldValue){
               $stmt->bindValue(":$field", $fieldValue);
     
          }
             $stmt->execute();

           return $this->pdo->lastInsertId();

     }


     //Update
     public function update($table, $prop, $value, $where_prop, $where_value){

          $query= "UPDATE $table SET $prop=:$prop WHERE $where_prop= :$where_prop;";

          $st= $this->pdo->prepare($query);

          $st->bindValue(":$prop", $value);
          $st->bindValue(":$where_prop", $where_value);

          return $st->execute();
      
     }


     //delete

     public function delete($table, $prop , $value){

     $query ="DELETE FROM $table WHERE $prop= :$prop;";

     $st= $this->pdo->prepare($query);
     $st->bindValue(":$prop", $value);

     return $st->execute();

     }





}
