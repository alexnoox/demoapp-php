<?php
session_start();
require_once '../../../init.php';

$marketplace = $_GET['marketplace'];

// Build SSO Response using SAMLResponse parameter value sent via
// POST request
$resp = Maestrano_Saml_Response::with($marketplace)->new($_POST['SAMLResponse']);

if ($resp->isValid()) {
    // Get the user as well as the user group
    $user = new Maestrano_Sso_User($resp);
    $group = new Maestrano_Sso_Group($resp);

    //-----------------------------------
    // No database model in this project. We just keep the
    // relevant details in session
    //-----------------------------------
    $_SESSION["loggedIn"] = true;
    $_SESSION["firstName"] = $user->getFirstName();
    $_SESSION["lastName"] = $user->getLastName();
    $_SESSION["marketplace"] = $_GET['marketplace'];

    // Important - Real id/email and Virtual id/email
    // getId() and getEmail() return the actual id and email of the user which are only unique across users.
    // If you chose to use the 'virtual mode' (recommended) then use getVirtualId() and getVirtualEmail().
    // They return a virtual (or composite) attribute which is truly unique across users and groups
    // Do not use the virtual email address to send emails to the user
    $_SESSION["id"] = $user->getId();
    $_SESSION["email"] = $user->getEmail();

    $_SESSION["vid"] = $user->getVirtualId();
    $_SESSION["vemail"] = $user->getVirtualEmail();

    // Store group details
    $_SESSION["groupId"] = $group->getId();
    $_SESSION["groupName"] = $group->getName();

    // Once the user is created/identified, we store the maestrano
    // session. This session will be used for single logout
    $mnoSession = new Maestrano_Sso_Session($_SESSION["marketplace"], $_SESSION, $user);
    $mnoSession->save();

    // Redirect the user to home page
    header('Location: /');
} else {
    echo "Holy Banana! Saml Response does not seem to be valid";
}
