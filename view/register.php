<?php

	require_once("../library/general.php");
	require_once("../library/form.php");
	require_once("../model/dal_user.php");

	$edit_user_data = null;
	if (isset($_GET['user_id'])) {
		$dal_user = new DAL_User();
		$edit_user_result = $dal_user->fetch_user_by_id($_GET['user_id']);
		if ($edit_user_result && mysqli_num_rows($edit_user_result) > 0) {
			$edit_user_data = mysqli_fetch_assoc($edit_user_result);
		}
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
            background: linear-gradient(to right, #4facfe, #00f2fe);
            /*display: flex;*/
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 20px;
        }
	</style>
</head>
<body>
	<div class="container">
		<?php General::site_header(); ?>
		<?php
			$forms = new Forms("login_process.php", "POST");
			$forms->register_form($edit_user_data);

			if (isset($_GET['message']) && isset($_GET['success'])) {
				?>
					<div class="text-center alert <?= $_GET['success']?"alert-success":"alert-danger"; ?>" id="auto-hide-alert">
						<?= $_GET['message']; ?>	
					</div>
				<?php
			}
		?>

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