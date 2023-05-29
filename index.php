<?php

$url = $_GET['url'];
// $request = $_SERVER['REQUEST_URI'];
switch ($url) {
  case 'about':
    include __DIR__ . '/model/about.php';
    break;
  case 'contact':
    include __DIR__ . '/controller/contact.php';
    break;
  default:
    include __DIR__ . '/view/home.php';
    break;
}
