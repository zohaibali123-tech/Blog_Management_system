<?php

	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../controller/bll_post.php");

	$session 	= new Session;
	$bll_post 	= new BLL_Post;

	$session_exists = $session->session_exists();

	if ($session_exists) {
		$session->editor_session();
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

		General::editor_menu();

		if ($posts->num_rows) {
			while ($data = mysqli_fetch_assoc($posts)) {
				?>
					<br>
					<div class="card text-center bg-transparent" style="width: 75%; margin: auto;">
						<div class="card-header bg-dark text-white">
							<?= $data['post_id']; ?>
						</div>
						<div class="card-body bg-white bg-opacity-50">
							<h5 class="card-title"><?= $data['title']; ?></h5>
							<p class="card-text"><?= substr($data['description'], 0, 500); ?></p>
							<a href="#" class="btn btn-primary">Read More</a>
						</div>
						<div class="card-footer bg-dark text-white">
							<p><b>By: </b><?= $data['first_name']." ".$data['last_name']; ?> <b>Date: </b><?= $data['added_on']; ?></p>
						</div>
					</div><br><br>
				<?php
			}
		} else {
			?>
				<div class="text-center alert alert-danger">No Posts Available..!</div>
			<?php
		}
	?>
</body>
</html>