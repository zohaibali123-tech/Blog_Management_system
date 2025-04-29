<?php

	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../controller/bll_user.php");

	$session 	= new Session;
	$bll_user 	= new BLL_User;

	$session_exists = $session->session_exists();

	if ($session_exists) {
		$session->admin_session();
	}

	$user_data = $bll_user->man_user();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= General::site_title(); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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

		General::admin_menu();

		if (isset($_GET['message']) && isset($_GET['success'])) {
			?>
				<div class="text-center alert <?= $_GET['success']?"alert-success":"alert-danger"; ?>" id="auto-hide-alert">
					<?= $_GET['message']; ?>	
				</div>
			<?php
		}
	?>
	<div class="container">
		<div class="row">
		<?php
			if ($user_data->num_rows) {	
				while ($data = mysqli_fetch_assoc($user_data)) {
		?>
					<div class="col-1"></div>
					<div class="col-5 g-4">
						<div class="card border-dark mb-3 text-center bg-transparent" style="max-width: 20rem;">
							<div class="card-header bg-dark text-white"><b>Profile: </b><?= $data['user_id']; ?></div>
							<div class="card-body bg-white bg-opacity-50">
								<h3 class="card-title"><b>Name: </b><?= $data['first_name']." ".$data['last_name']; ?></h3>
								<p class="card-text">
									<b>Contact: </b><br>
									<tr>
										<td>Email: </td>
										<td><?= $data['email']; ?></td>
									</tr>
									<br>
									<tr>
										<td>Phone Number: </td>
										<td><?= $data['phone_number']; ?></td>
									</tr>
								</p>
							</div>
							<div class="card-footer bg-dark text-white">
								<a href="../register.php?user_id=<?= $data['user_id']; ?>" class="btn btn-success">Edit</a>
									&nbsp; | &nbsp;
								<a href="manage_user_process.php?action=delete&user_id=<?= $data['user_id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure You Want to Delete This User?');">Delete</a>
							</div>
						</div>
					</div>
		<?php
				}
			} else {
				?>
					<div class="text-center alert alert-danger">No Posts Available..!</div>
				<?php
			}
		?>
		</div>
	</div>

	<script>
		setTimeout(function() {
			var alertBox = document.getElementById('auto-hide-alert');
			if (alertBox) {
				alertBox.style.display = 'none';
			}
		}, 4000);
	</script>

</div>
</body>
</html>
