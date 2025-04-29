<?php

	require_once("../../library/session.php");
	require_once("../../controller/bll_post.php");

	$session 	= new Session;
	$bll_post 	= new BLL_Post;

	$session_exists = $session->session_exists();

	if ($session_exists) {
		$session->admin_session();
	}

	if (isset($_POST['add_post']) && $_POST['add_post'] == "Add Post") {
		$bll_post->set_title($_POST['title']);
		$bll_post->set_description($_POST['description']);
		$bll_post->set_added_by($_SESSION['user']['user_id']);
		$bll_post->set_added_on(time());

		$result = $bll_post->add_post($bll_post->get_title(), $bll_post->get_description(), $bll_post->get_added_by());

		if ($result) {
			header("location: manage_post.php?message=Post Added Successfully..!&success=1");
		} else {
			header("location: manage_post.php?message=Post Not Added Try Again Later..!&success=0");
		}
	} else if (isset($_POST['edit_post']) && $_POST['edit_post'] == "Update Post") {

		$post_id = $_POST['post_id'];
		$title = $_POST['title'];
		$description = $_POST['description'];

		$bll_post->set_title($title);
		$bll_post->set_description($description);

		$result = $bll_post->edit_post($post_id, $bll_post->get_title(), $bll_post->get_description());

		if ($result) {
			header("location: manage_post.php?message=Post Updated Successfully..!&success=1");
		} else {
			header("location: manage_post.php?message=Post Not Updated Try Again Later..!&success=0");
		}
	} elseif (isset($_GET['action']) && $_GET['action'] == "delete") {
		$post_id = $_GET['post_id'];    
		$result = $bll_post->delete_post($post_id);

		if ($result) {
			header("location: manage_post.php?message=Post Deleted Successfully..!&success=1");
		} else {
			header("location: manage_post.php?message=Post Not Deleted Try Again Later..!&success=0");
		}
	}

?>