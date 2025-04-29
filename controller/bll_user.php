<?php

	require_once(__DIR__ . '/../model/dal_user.php');

	class BLL_User extends DAL_User {
		private $user_role_type_id 	= NULL;
		private $first_name 		= NULL;
		private $last_name 			= NULL;
		private $email 				= NULL;
		private $user_password 		= NULL;
		private $phone_number 		= NULL;
		private $user_result 		= NULL;

		public function set_user_role_type_id($user_role_type_id) {
			$this->user_role_type_id = $user_role_type_id;
		}

		public function set_first_name($first_name) {
			$this->first_name = $first_name;
		}

		public function set_last_name($last_name) {
			$this->last_name = $last_name;
		}

		public function set_email($email) {
			$this->email = $email;
		}

		public function set_password($password) {
			$this->user_password = $password;
		}

		public function set_phone_number($phone_number) {
			$this->phone_number = $phone_number;
		}

		public function get_user_role_type_id() {
			return $this->user_role_type_id;
		}

		public function get_first_name() {
			return $this->first_name;
		}

		public function get_last_name() {
			return $this->last_name;
		}

		public function get_email() {
			return $this->email;
		}

		public function get_password() {
			return $this->user_password;
		}

		public function get_phone_number() {
			return $this->phone_number;
		}

		public function user_login() {
			$this->user_result = $this->login($this->email, $this->get_password());
			return $this->user_result;
		}

		public function role() {
			$this->user_result = $this->role_user();
			return $this->user_result;
		}

		public function user_register() {
			$this->user_result = $this->register($this->get_user_role_type_id(), $this->get_first_name(), $this->get_last_name(), $this->get_email(), $this->get_password(), $this->get_phone_number());
			return $this->user_result;
		}

		public function man_user() {
			$this->user_result = $this->user();
			return $this->user_result;
		}

		public function del_user($user_id) {
			$this->user_result = $this->delete_user($user_id);
			return $this->user_result;
		}

		public function edit_user($user_id, $user_role_type_id, $first_name, $last_name, $email, $password, $phone_number) {
			$this->user_result = $this->update_user($user_id, $user_role_type_id, $first_name, $last_name, $email, $password, $phone_number);

			return $this->user_result;
		}

		public function get_old_password($user_id) {
			$this->user_result = $this->fetch_user_password($user_id);
			
			return $this->user_result;
		}
	}

?>