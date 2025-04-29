<?php

	session_start();

	class Session {
		public function set_session($data) {
			$_SESSION['user'] = $data;
		}

		public function destroy_session() {
			unset($_SESSION['user']);
			session_destroy();
		}

		public function is_admin() {
			if ($_SESSION['user']['user_role_type_id'] == 1) {
				return true;
			} else {
				return false;
			}
		}

		public function is_editor() {
			if ($_SESSION['user']['user_role_type_id'] == 2) {
				return true;
			} else {
				return false;
			}
		}

		public function is_user() {
			if ($_SESSION['user']['user_role_type_id'] == 3) {
				return true;
			} else {
				return false;
			}
		}

		public function admin_session() {
			if (isset($_SESSION['user']) && $_SESSION['user']['user_role_type_id'] != 1) {
				$this->destroy_session();
				header("location: ../index.php?message=Please Login Into Your Account..!&success=1");
			}
		}

		public function editor_session() {
			if (isset($_SESSION['user']) && $_SESSION['user']['user_role_type_id'] != 2) {
				$this->destroy_session();
				header("location: ../index.php?message=Please Login Into Your Account..!&success=1");
			}
		}

		public function user_session() {
			if (isset($_SESSION['user']) && $_SESSION['user']['user_role_type_id'] != 3) {
				$this->destroy_session();
				header("location: ../index.php?message=Please Login Into Your Account..!&success=1");
			}
		}

		public function session_exists() {
			if (isset($_SESSION['user'])) {
				return true;
			} else {
				header("location: ../index.php?message=Login Into Your Account..!&success=0");
			}
		}
	}

?>