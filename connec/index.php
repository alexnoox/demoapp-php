<?php
require_once '../init.php';
session_start();

$organizations = [];

// Handle action when user is logged in
if ($_SESSION["loggedIn"]) {

    $groupId = $_SESSION['groupId'];
    $marketplace = $_SESSION['marketplace'];

    $mnoSession = new Maestrano_Sso_Session($marketplace, $_SESSION);

    // Check session validity and trigger SSO if not
    if (!$mnoSession->isValid()) {
        header('Location: ' . Maestrano::sso()->getInitPath());
    }

    // Create a connec! client
    $client = Maestrano_Connec_Client::with($marketplace)->new($groupId);

    # Fetch the organizations and decode them
    $resp = $client->get('/organizations');
    $organizations = json_decode($resp['body'], true)['organizations'];
}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Maestrano PHP Demo App</title>

    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <a class="brand" href="/">DemoApp</a>
            <ul class="nav">
                <li><a href="/">Home</a></li>

                <? if ($_SESSION["loggedIn"]) { ?>
                    <li><a href="/bills">Bills</a></li>
                    <li><a href="/connec">Connec!</a></li>
                    <li><a href="/logout.php">Logout</a></li>
                <? } ?>
            </ul>
        </div>
    </div>

    <div class="container" style="margin-top: 60px;">
        <div class="row">
            <div class="span12" style="text-align: center;">
                <? if (!$_SESSION["loggedIn"]) { ?>
                    <p class="text-error">
                        You need to be logged in to see your Connec! organisations
                    </p>
                <? } else { ?>
                    <p>Below are the <b>organizations</b> related to group: <b><?= $_SESSION["groupName"] ?></b></p>
                    <p>Create new organisations in another app (eg. vTiger or Xero) to see them listed here.</p>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($organizations as $org) { ?>
                            <tr>
                                <td><?= $org['code'] ?></td>
                                <td><?= $org['name'] ?></td>
                                <td><?= $org['status'] ?></td>
                                <td><?= $org['created_at'] ?></td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                <? } ?>
            </div>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
</body>
</html>