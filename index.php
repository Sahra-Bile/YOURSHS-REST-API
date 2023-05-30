<?php
$pdo = require_once __DIR__ . '/partials/connect.php';

// //! garments 
require_once __DIR__ . '/model/garment-model.php';
require_once __DIR__ . '/controller/garment-controller.php';
require_once __DIR__ . '/view/garment-view.php';



// //! garments MVC
$garmentModel = new GarmentModel($pdo);
$garmentView = new GarmentView();
$garmentController = new GarmentController($garmentModel, $garmentView);


$url = $_GET['url'];
$requestMethod = $_SERVER["REQUEST_METHOD"];


if (strpos($url, 'garments/') === 0) {
  $id = substr($url, strlen('garments/')); // hämtar värdet för variabeln "id"
  $garmentController->getGarment($id);
} else {
  switch ($url) {
    case 'garments':
      if ($requestMethod == "GET") {
        $garmentController->getAll();
      } elseif ($requestMethod == "POST") {
        $garmentController->add();
      } else {
        echo "this is an invalid url..";
      }
      break;
    default:
      include_once __DIR__ . '/index.php';
      break;
  }
}
