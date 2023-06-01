<?php

class SellerView
{


  public function outputSeller(array $sellers): void
  {
    $json = [
      'seller-count' => count($sellers),
      'result' => $sellers
    ];
    header("Content-Type: application/json");
    echo json_encode($json);
  }



  public function displaySeller(array $seller): void
  {
    $json = [
      'seller-count' => count($seller),
      'result' => $seller
    ];

    header("Content-Type: application/json");
    echo json_encode($json);

  }
  public function outputListSellerSubmissionsOfGarments(array $seller): void
  {
    $json = [
      "message" => " list of seller submissions of garments",
      'seller-count' => count($seller),
      'result' => $seller
    ];

    header("Content-Type: application/json");
    echo json_encode($json);

  }
  public function outputTotalAmountFromSoldGarments(array $seller): void
  {
    $json = [
      "message" => " total revenue by seller from sold garments",
      'seller-count' => count($seller),
      'result' => $seller
    ];

    header("Content-Type: application/json");
    echo json_encode($json);

  }

  public function outputNumberOfSubmittedGarments(array $seller): void
  {
    $json = [
      "message" => "number of submitted garments from The seller",
      'seller-count' => count($seller),
      'result' => $seller
    ];

    header("Content-Type: application/json");
    echo json_encode($json);

  }



  public function createNewSeller(array $seller): void
  {
    $json = [
      'message' => "added a new seller successfully!"
    ];
    header("Content-Type: application/json");
    echo json_encode($json);

  }

}
