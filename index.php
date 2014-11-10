<?php
require_once 'init.php';
session_start();

?>

<html>
<head>
<meta charset="utf-8">
<title>Maestrano PHP Demo App</title>

<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link
	href="//netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css"
	rel="stylesheet">
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
      <a class="brand" href="/">DemoApp</a>
      <ul class="nav">
        <li><a href="/">Home</a></li>

        <? if ($_SESSION["loggedIn"]) { ?>
          <li><a href="/bills">Bills</a></li>
          <li><a href="/logout.php">Logout</a></li>
        <? } ?>
      </ul>
		</div>
	</div>

	<div class="container" style="margin-top: 60px;">
		<div class="row">
      <div class="span8 offset2" style="text-align: center;">
        <? if ($_SESSION["loggedIn"]) { ?>
        <h4>
          Hello
          <?= $_SESSION["firstName"] ?>
          <?= $_SESSION["lastName"] ?>
        </h4>
        <br />
        <p>
          You logged in via group <b><?= $_SESSION["groupName"] ?></b>
        </p>
        <? } else { ?>
        <a class="btn btn-large"
          href="<?= Maestrano::sso()->getInitPath() ?>">Login</a>
        <? } ?>
      </div>
    </div>
	</div>
	</div>

	<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
	<script
		src="//netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
</body>
</html>