<?php
  require_once '../init.php';
  header('Content-Type: application/json');

  if (Maestrano::authenticate($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'])) {
    if (array_key_exists('marketplace', $_GET)) {
      $marketplace = $_GET['marketplace'];
      echo Maestrano::with($marketplace)->toMetadata();
    } else {
      echo 'Marketplace get param is missing';
    }
  } else {
    echo "Sorry! I'm not giving you my API metadata";
  }
