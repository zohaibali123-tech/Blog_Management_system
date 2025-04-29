<?php

	require_once(__DIR__ . '/../library/database.php');

	class DAL_User extends Database {
		protected function login($email, $password) {
			$this->query = "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'";

			$this->result = mysqli_query($this->connection, $this->query,) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		protected function role_user() {
			$this->query = "SELECT * FROM user_role_type WHERE user_role_type != 'Admin'";

			$this->result = mysqli_query($this->connection, $this->query,) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		protected function register($user_role_type_id, $first_name, $last_name, $email, $password, $phone_number) {
			$this->query = "INSERT INTO user (user_role_type_id, first_name, last_name, email, password, phone_number) VALUES ('".$user_role_type_id."', '".$first_name."','".$last_name."','".$email."','".$password."','".$phone_number."')";

			$this->result = mysqli_query($this->connection, $this->query,) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		protected function user() {
			$user_id = $_SESSION['user']['user_id'];
			$this->query = "SELECT * FROM user WHERE user_id != '$user_id'";

			$this->result = mysqli_query($this->connection, $this->query,) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		protected function delete_user($user_id) {
			$this->query = "DELETE FROM user WHERE user_id = '$user_id'";

			$this->result = mysqli_query($this->connection, $this->query,) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		public function fetch_user_by_id($user_id) {
			$this->query = "SELECT * FROM user WHERE user_id = '$user_id'";

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			return $this->result;
		}

		protected function update_user($user_id, $user_role_type_id, $first_name, $last_name, $email, $password, $phone_number) {
			$this->query = "UPDATE user SET user_role_type_id = '$user_role_type_id', first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', phone_number = '$phone_number' WHERE user_id = '$user_id'";

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		protected function fetch_user_password($user_id) {
			$this->query = "SELECT password FROM user WHERE user_id = '$user_id'";
			
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			if ($row = mysqli_fetch_assoc($this->result)) {
				return $row['password'];
			} else {
				return null;
			}
		}
	}

?>