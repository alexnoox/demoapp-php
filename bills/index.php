<?php
require_once '../init.php';
session_start();

$bills = []

// Handle action when user is logged in
if ($_SESSION["loggedIn"]) {
  $mnoSession = new Maestrano_Sso_Session($_SESSION);
  
  // Check session validity and trigger SSO if not
  if (!$mnoSession->isValid()) {
    header('Location: ' . Maestrano::sso()->getInitUrl());
  }
  
  // Retrieve all related to the user group
  $bills = Maestrano_Account_Bill::all(array('groupId' => $_SESSION['groupId']));
}


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
			<div class="span12" style="text-align: center;">
				<? if (!$_SESSION["loggedIn"]) { ?>
				<p class="text-error">
					You need to be logged in to see your Maestrano bills
				</p>
				<? } else { ?>
				<p>Below are the bills related to the group: <?= $_SESSION["groupName"] ?></p>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>UID</th>
							<th>Description</th>
							<th>Price (cents)</th>
							<th>Currency</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
						<? foreach ($bills as $bill) { ?>
						<tr>
							<td><?= $bill->getId() ?></td>
							<td><?= $bill->getDescription() ?></td>
							<td><?= $bill->getPriceCents() ?></td>
							<td><?= $bill->getCurrency() ?></td>
							<td><?= $bill->getCreatedAt()->format(DateTime::ISO8601) ?></td>
						</tr>
						<? } ?>
					</tbody>
				</table>
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