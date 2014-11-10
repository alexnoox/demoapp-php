<?php
  require_once '../../../init.php';
  
  // Build SSO request - Make sure GET parameters gets passed
  // to the constructor
  $req = new Maestrano_Saml_Request($_GET);
  
  // Redirect the user to Maestrano Identity Provider
  header('Location: ' . $req->getRedirectUrl());
?>