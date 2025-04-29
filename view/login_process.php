<?php

	require_once("../controller/bll_user.php");
	require_once("../library/session.php");

	$bll_user 	= new BLL_User;
	$session 	= new Session;
	
	if (isset($_POST['login_form']) && $_POST['login_form'] == "Login") {
		$bll_user->set_email($_POST['email']);
		$bll_user->set_password($_REQUEST['password']);
		$result = $bll_user->user_login();

		if ($result->num_rows) {
			$data = mysqli_fetch_assoc($result);

			$session->set_session($data);

			if ($session->is_admin()) {
				header("location: admin/dashboard.php");
			} elseif ($session->is_editor()) {
				header("location: editor/dashboard.php");
			} elseif ($session->is_user()) {
				header("location: user/dashboard.php");
			}
		} else {
			header("location: index.php?message=Invalid Email/Password Try Again Later..!&success=0");
		}
	} elseif (isset($_POST['register_form']) && $_POST['register_form'] == "Register") {
		$bll_user->set_user_role_type_id($_POST['role']);
		$bll_user->set_first_name($_POST['first_name']);
		$bll_user->set_last_name($_POST['last_name']);
		$bll_user->set_email($_POST['email']);
		$bll_user->set_password($_POST['password']);
		$bll_user->set_phone_number($_POST['phone_number']);
		$result = $bll_user->user_register();

		if ($result) {
			header("location: index.php?message=You Are Successfully Registered..!&success=1");
		} else {
			header("location: register.php?message=You Are Not Registered Try Again..!&success=0");
		}
	} elseif (isset($_POST['update_user']) && $_POST['update_user'] == "Update") {

		$user_id 		= $_POST['user_id'];
		$role 			= $_POST['role'];
		$first_name 	= $_POST['first_name'];
		$last_name 		= $_POST['last_name'];
		$email 			= $_POST['email'];
		$password 		= $_POST['password'];
		$phone_number 	= $_POST['phone_number'];

		if (empty($password)) {
			$password = $bll_user->get_old_password($user_id);
		}

		$bll_user->set_user_role_type_id($role);
		$bll_user->set_first_name($first_name);
		$bll_user->set_last_name($last_name);
		$bll_user->set_email($email);
		$bll_user->set_password($password);
		$bll_user->set_phone_number($phone_number);

		$result = $bll_user->edit_user($user_id, $bll_user->get_user_role_type_id(), $bll_user->get_first_name(), $bll_user->get_last_name(), $bll_user->get_email(), $bll_user->get_password(), $bll_user->get_phone_number());

		if ($result) {
			header("location: admin/manage_user.php?message=User Updated Successfully Registered..!&success=1");
		} else {
			header("location: admin/manage_user.php?message=User Not Update Try Again..!&success=0");
		}
	}	

?>