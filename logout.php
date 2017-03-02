<?php
require_once 'init.php';
session_start();
session_destroy();

// Redirect to IDP logout url
$mnoSession = new Maestrano_Sso_Session($_SESSION["marketplace"], $_SESSION);
$logoutUrl = $mnoSession->getLogoutUrl();

header("Location: $logoutUrl");
