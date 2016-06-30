<?php
  require_once '../../../init.php';

  // Build SSO request - Make sure GET parameters gets passed
  // to the constructor
  $marketplace = $_GET['marketplace'];
  $req = Maestrano_Saml_Request::with($marketplace)->new($_GET);

  // Redirect the user to Maestrano Identity Provider
  header('Location: ' . $req->getRedirectUrl());
