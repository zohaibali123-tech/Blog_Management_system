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
	};

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
            /*display: flex;*/
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
		?>
			<br>
		<?php
			if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
				$post_id = $_GET['post_id'];
				$post_data = $bll_post->get_post_by_id($post_id);

				$forms = new Forms("manage_post_process.php", "POST");
				$forms->post_form($post_data);
			} else {
				$forms = new Forms("manage_post_process.php", "POST");
				$forms->post_form();
			}
		?>
	
</body>
</html>