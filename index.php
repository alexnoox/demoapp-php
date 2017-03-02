<?php
session_start();
require_once 'init.php';

// Handle action when user is logged in
if (array_key_exists('loggedIn', $_SESSION) && $_SESSION['loggedIn']) {
    // Get the current session
    $mnoSession = new Maestrano_Sso_Session($_SESSION['marketplace'], $_SESSION);

    // Check session validity and trigger SSO if not
    if (!$mnoSession->isValid()) {
        header('Location: ' . Maestrano::sso()->getInitPath());
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Maestrano PHP Demo App</title>

    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css">
</head>
<body>
	<div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <a class="brand" href="/">DemoApp</a>
            <ul class="nav">
                <li><a href="/">Home</a></li>
                <?php if (array_key_exists('loggedIn', $_SESSION) && $_SESSION['loggedIn']): ?>
                  <li><a href="/bills">Bills</a></li>
                  <li><a href="/connec">Connec!</a></li>
                  <li><a href="/logout.php">Logout</a></li>
                <?php endif ?>
            </ul>
		</div>
	</div>
    <div class="container" style="margin-top: 60px;">
        <div class="row">
            <div class="span8 offset2" style="text-align: center;">
                <?php if (array_key_exists('loggedIn', $_SESSION) && $_SESSION["loggedIn"]): ?>
                    <h4>
                        Hello
                        <?= $_SESSION["firstName"] ?>
                        <?= $_SESSION["lastName"] ?>
                    </h4>
                    <br/>
                    <p>
                        You logged in via group <b><?= $_SESSION["groupName"] ?></b> on marketplace <b><?= $_SESSION["marketplace"] ?></b>
                    </p>
                <?php else: ?>
                    <h3>Sandbox</h3>
                    Please go to <a href="http://sandbox.maestrano.com">http://sandbox.maestrano.com</a> to test this application.
                    <?php if (!empty(Maestrano::getMarketplacesList())): ?>
                        <h3>Discovered Marketplaces</h3>
                        <?php foreach (Maestrano::getMarketplacesList() as $name): ?>
                            <a href="<?= Maestrano::with($name)->sso()->getHost() ?>"><h4><?= $name ?></h4></a>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </div>

	<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
</body>
</html>