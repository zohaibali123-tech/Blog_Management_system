<?php

	require_once("../../library/session.php");
	require_once("../../library/general.php");

	$session 	= new Session;

	$session_exists = $session->session_exists();

	if ($session_exists) {
		$session->user_session();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= General::site_title(); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
	<style type="text/css">

		body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, lightpink, lightcyan);
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 20px;
        }
	</style>
</head>
<body>
	<?php
		General::site_header();

		General::user_menu();
	?>
	<center>
		<br>
		<div class="card border-dark mb-3 text-center bg-transparent" style="max-width: 20rem;">
			<div class="card-header bg-dark text-white"><b>Profile: </b><?= $_SESSION['user']['user_id']; ?></div>
			<div class="card-body bg-white bg-opacity-50">
				<h3 class="card-title"><b>Name: </b><?= $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?></h3>
				<p class="card-text">
					<b>Contact: </b><br>
					<tr>
						<td>Email: </td>
						<td><?= $_SESSION['user']['email']; ?></td>
					</tr>
					<br>
					<tr>
						<td>Phone Number: </td>
						<td><?= $_SESSION['user']['phone_number']; ?></td>
					</tr>
				</p>
			</div>
		</div>
	</center>
</body>
</html>
