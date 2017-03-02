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

    // TODO: Update this comment
    // Important - toId() and toEmail() have different behaviour compared to
    // getId() and getEmail(). In you maestrano configuration file, if your sso > creation_mode 
    // is set to 'real' then toId() and toEmail() return the actual id and email of the user which
    // are only unique across users.
    // If you chose 'virtual' then toId() and toEmail() will return a virtual (or composite) attribute
    // which is truly unique across users and groups
    $_SESSION["id"] = $user->getId();
    $_SESSION["email"] = $user->getEmail();

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
