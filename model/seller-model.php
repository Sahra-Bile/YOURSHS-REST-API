<?php
require_once __DIR__ . "/db.php";

class SellerModel extends Database
{
  protected $table = "sellers";


  public function getAllSellers()
  {
    $query = "SELECT * FROM $this->table ORDER BY first_name  ASC, last_name DESC ";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

  }



  public function getSellerById(int $id)
  {

    $query = "SELECT * FROM $this->table
    WHERE id = ?
    ORDER BY id";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$id]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addSeller(string $firstName, string $lastName, string $email, string $phone)
  {
    $query = "INSERT INTO $this->table (`first_name`, `last_name`, `email`,  `phone`) VALUES (?,?,?,?)";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$firstName, $lastName, $email, $phone]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getListOfSellerSubmissionsOfGarments(int $sellerId)
  {

    $sqlQuery = " SELECT g.name  'product_name' , g.type 'product_type', g.description 'product_description', g.price 'product_price', 
    g.sold_date 'product_sold_date' FROM $this->table  s  
    JOIN garments g ON  s.id = g.sellerId WHERE s.id = ?";

    $statement = $this->pdo->prepare($sqlQuery);
    $statement->execute([$sellerId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }



  public function getTotalRevenueBySellerFromSoldGarments(int $sellerId)
  {
    $sql_query = "SELECT s.first_name , s.last_name,  
    COUNT(g.sold_date)  AS ' number of  sold garments',  
    SUM(g.price)  'total sales amount' FROM $this->table  s
    JOIN garments g  ON g.sellerId = s.id
    WHERE g.sold_date IS NOT NULL AND s.id = ? ";

    $statement = $this->pdo->prepare($sql_query);
    $statement->execute([$sellerId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);

  }

  public function numberOfSubmittedGarmentsFromTheSeller(int $sellerId)
  {

    $sql_query = " SELECT s.first_name , s.last_name , 
    COUNT(s.id)  AS `number of submitted  garments` FROM $this->table  s
      JOIN garments  g ON g.sellerId = s.id
    WHERE s.id = ? ORDER BY s.id";
    $statement = $this->pdo->prepare($sql_query);
    $statement->execute([$sellerId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);

  }



}
