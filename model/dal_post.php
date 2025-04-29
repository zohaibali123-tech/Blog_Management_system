<?php

	require_once("../../library/database.php");

	class DAL_Post extends Database {
		protected function get_all_posts() {
			$this->query = "SELECT * FROM post, user WHERE post.added_by=user.user_id ORDER BY post_id DESC";

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		protected function insert_post($title, $description, $added_by) {
			$this->query = "INSERT INTO post (title, description, added_by) VALUES ('".htmlspecialchars($title, true)."', '".htmlspecialchars($description, true)."', '".$added_by."')";

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		public function get_post_by_id($post_id) {
			$this->query = "SELECT * FROM post WHERE post_id = '$post_id'";
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return mysqli_fetch_assoc($this->result);
		}

		protected function update_post($post_id, $title, $description) {
			$this->query = "UPDATE post SET title = '$title', description = '$description' WHERE post_id = '$post_id'";

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}

		protected function del_post($post_id) {
			$this->query = "DELETE FROM post WHERE post_id = '$post_id'";

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red;'><b>Error No: </b>".mysqli_errno($this->connection)."</p><p style='color: red;'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			return $this->result;
		}
	}

?>