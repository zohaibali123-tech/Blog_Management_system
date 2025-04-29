<?php

	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../library/form.php");
	require_once("../../controller/bll_post.php");

	$session 	= new Session;
	$bll_post 	= new BLL_Post;
	$forms 		= new Forms("manage_post_process.php", "POST");

	$session_exists = $session->session_exists();

	if ($session_exists) {
		$session->admin_session();
	}

	$posts = $bll_post->show_all_posts();

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

		General::admin_menu();

		if (isset($_GET['message']) && isset($_GET['success'])) {
			?>
				<div class="text-center alert <?= $_GET['success']?"alert-success":"alert-danger"; ?>" id="auto-hide-alert">
					<?= $_GET['message']; ?>	
				</div>
			<?php
		}

	?>
		<center>
			<br><a href="add_post.php" class="btn btn-success w-25">Add Post</a><br>
		</center>
		<div class="container">
			<div class="row">
	<?php
		if ($posts->num_rows) {	
			while ($data = mysqli_fetch_assoc($posts)) {
				?>	
					<div class="col-6 g-4">
						<div class="col">
							<div class="card bg-transparent">
								<div class="card-header text-center bg-dark text-white">
									<small><b>Post ID : <?= $data['post_id']; ?></b></small>
								</div>
								<div class="card-body bg-white bg-opacity-50">
									<h5 class="card-title">Title : <?= $data['title']; ?></h5>
									<p class="card-text"><b>Description : </b><?= substr($data['description'], 0, 500); ?> &nbsp; <a href="#" class="btn btn-primary">Read More</a></p>
								</div>
								<div class="card-footer bg-dark text-white">
									<small class="text-body-white"><b>Last updated : </b>(<?= $data['added_on']; ?>) <?= $data['first_name']." ".$data['last_name']; ?></small>&nbsp;&nbsp;&nbsp;
									<a href="add_post.php?post_id=<?= $data['post_id']; ?>" class="btn btn-success">Edit</a>
												&nbsp; | &nbsp;
									<a href="manage_post_process.php?action=delete&post_id=<?= $data['post_id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure You Want to Delete This Post?');">Delete</a>
								</div>
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

</body>
</html>