<?php
include_once __DIR__ . '/db.php';

class GarmentModel extends Database
{
  protected $table = "garments";

  public function getAllGarments()
  {
    return $this->getAll($this->table);

  }

  public function getGarmentById($id)
  {
    $query = "SELECT * FROM $this->table  WHERE id = ?";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$id]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }



  public function addGarment(int $sellerId, string $name, string $type, string $description, float $price, bool $sold, string $sold_date)
  {
    $query = "INSERT INTO $this->table (`sellerId`, `name`, `type`,  `description`, `price`, `sold`) VALUES (?,?,?,?,?,?,?)";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$sellerId, $name, $type, $description, $price, $sold, $sold_date]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}
