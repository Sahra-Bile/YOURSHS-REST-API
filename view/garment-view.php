<?php

class GarmentView
{

  public function outputGarments(array $garments): void
  {
    $json = [
      'garment-count' => count($garments),
      'result' => $garments
    ];
    header("Content-Type: application/json");
    echo json_encode($json);
  }

  public function displayGarment(array $garment): void
  {
    $json = [
      'garment-count' => count($garment),
      'result' => $garment
    ];

    header("Content-Type: application/json");
    echo json_encode($json);

  }

  public function createNewGarment(array $garment): void
  {
    $json = [
      'garment-count' => count($garment),
      'result' => $garment,
      'message' => "added a new garment successfully!"
    ];
    header("Content-Type: application/json");
    echo json_encode($json);
  }

  public function outputUpdatedGarment(array $garment): void
  {
    $json = [
      'result' => $garment,
      'message' => "updated successfully!"
    ];
    header("Content-Type: application/json");
    echo json_encode($json);

  }



}
