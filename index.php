<?php
session_start();
require_once 'init.php';

// Handle action when user is logged in
if (array_key_exists('loggedIn', $_SESSION) && $_SESSION['loggedIn']) {
  $mnoSession = new Maestrano_Sso_Session($_SESSION);
  
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
                    <?php foreach (Maestrano::getMarketplacesList() as $name): ?>
                        <a class="btn btn-large" href="<?= Maestrano::with($name)->sso()->getInitPath() ?>">Login (<?= $name ?>)</a>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>

	<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
</body>
</html>