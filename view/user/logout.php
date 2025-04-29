<?php

	require_once("../../library/session.php");

	$session = new Session;

	$session->destroy_session();

	header("location: ../index.php?message=You Have Logged Out From Your Account Successfully..!&success=1");

?>