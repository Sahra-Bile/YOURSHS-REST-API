<?php
class SellerController
{
  private $model = null;
  private $view = null;

  public function __construct($garmentModel, $garmentView)
  {
    $this->model = $garmentModel;
    $this->view = $garmentView;
  }

  public function getAll()
  {
    $all = $this->model->getAllSellers();
    $this->view->outputSeller($all);

  }

  public function getSellerById($id)
  {
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    switch ($requestMethod) {
      case 'GET':
        $one = $this->model->getSellerById($id);
        $this->view->displaySeller($one);
        break;

    }
  }


  public function getListOfGarments($id)
  {
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    switch ($requestMethod) {
      case 'GET':
        $one_1 = $this->model->getListOfSellerSubmissionsOfGarments($id);

        $this->view->outputListSellerSubmissionsOfGarments($one_1);
        break;

    }
  }

  public function totalSalesAmount($id)
  {
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    switch ($requestMethod) {
      case 'GET':
        $one_2 = $this->model->getTotalRevenueBySellerFromSoldGarments($id);

        $this->view->outputTotalAmountFromSoldGarments($one_2);
        break;

    }
  }

  public function numberOfSubmittedGarments($id)
  {
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    switch ($requestMethod) {
      case 'GET':
        $one_3 = $this->model->numberOfSubmittedGarmentsFromTheSeller($id);
        $this->view->outputNumberOfSubmittedGarments($one_3);
        break;

    }
  }

  public function createSeller()
  {
    $json = file_get_contents("php://input");

    $data = json_decode($json, true);

    if (isset($data['first_name'], $data['last_name'], $data['email'], $data['phone'])) {

      $firstName = filter_var($data['first_name'], FILTER_SANITIZE_SPECIAL_CHARS);

      $lastName = filter_var($data['last_name'], FILTER_SANITIZE_SPECIAL_CHARS);

      $email = filter_var($data['email'], FILTER_SANITIZE_SPECIAL_CHARS);

      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      $phone = filter_var($data['phone'], FILTER_SANITIZE_SPECIAL_CHARS);


      $one = $this->model->addSeller($firstName, $lastName, $email, $phone);

      $this->view->createNewSeller($one);
    } else {
      echo "OBS: could not add a new seller.";
    }
  }
}
