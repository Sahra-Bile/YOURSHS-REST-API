<?php
$pdo = require_once __DIR__ . '/partials/connect.php';

// //! garments 
require_once __DIR__ . '/model/garment-model.php';
require_once __DIR__ . '/controller/garment-controller.php';
require_once __DIR__ . '/view/garment-view.php';

require_once __DIR__ . '/model/seller-model.php';
require_once __DIR__ . '/controller/seller-controller.php';
require_once __DIR__ . '/view/seller.view.php';


// //! garments MVC
$garmentModel = new GarmentModel($pdo);
$garmentView = new GarmentView();
$garmentController = new GarmentController($garmentModel, $garmentView);

$sellerModel = new SellerModel($pdo);
$sellerView = new SellerView();
$sellerController = new SellerController($sellerModel, $sellerView);

$url = $_GET['url'];
$requestMethod = $_SERVER["REQUEST_METHOD"];

if (strpos($url, 'sellers/') === 0) {

  $id = substr($url, strlen('sellers/'));
  $sellerController->getSellerById($id);

}
//!get list of seller submissions of garments
if (strpos($url, 'submission-garments/') === 0) {
  $id = substr($url, strlen('submission-garments/'));
  $sellerController->getListOfGarments($id);

}
//!get total revenue by seller from sold garments
if (strpos($url, 'total-sales-amount/') === 0) {
  $id = substr($url, strlen('total-sales-amount/'));
  $sellerController->totalSalesAmount($id);

}
//!number of submitted garments from The seller
if (strpos($url, 'garments-submitted/') === 0) {
  $id = substr($url, strlen('garments-submitted/'));
  $sellerController->numberOfSubmittedGarments($id);

}
if (strpos($url, 'garments/') === 0) {
  $id = substr($url, strlen('garments/'));
  $garmentController->getGarmentById($id);
}
if ($requestMethod == "PUT") {
  $garmentController->update($id);


} else {
  switch ($url) {
    case 'garments':
      if ($requestMethod == "GET") {
        $garmentController->getAll();
      } elseif ($requestMethod == "POST") {
        $garmentController->add();
      } else {
        echo "Invalid Request Method for garments.";
      }
      break;
    case 'sellers':
      if ($requestMethod == "GET") {
        $sellerController->getAll();
      } elseif ($requestMethod == "POST") {
        $sellerController->createSeller();
      } else {
        echo "Invalid Request Method for sellers.";
      }
      break;
    default:
      include_once __DIR__ . '/index.php';
      break;
  }

}
