<?php

	require_once("../../controller/bll_user.php");
	$bll_user = new BLL_User;

	if (isset($_GET['action']) && $_GET['action'] == 'delete') {
		$user_id = $_GET['user_id'];
		$result = $bll_user->del_user($user_id);

		if ($result) {
			header("location: manage_user.php?message=User Deleted Successfully..!&success=1");
		} else {
			header("location: manage_user.php?message=User Not Deleted Try Again Later..!&success=0");
		}	
	}

?>