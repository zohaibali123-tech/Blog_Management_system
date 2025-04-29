<?php

	$mysqli_driver = new mysqli_driver();
	$mysqli_driver->report_mode = MYSQLI_REPORT_OFF;

	class Database {
		protected $host_name 	= "localhost";
		protected $user_name 	= "root";
		protected $password 	= "";
		protected $database 	= "blog_system";
		protected $connection 	= NULL;
		protected $query 		= NULL;
		protected $result 		= NULL;

		public function __construct() {
			$this->connection = mysqli_connect($this->host_name, $this->user_name, $this->password, $this->database);
			if (mysqli_connect_errno()) {
				echo "<p style='color: red; font_weight: bolder;'>Database Connection Problem..!</p>";
				echo "<p style='color: red'><b>Error No: </b>".mysqli_connect_errno()."</p>";
				echo "<p style='class: red'><b>Error Message: </b>".mysqli_connect_error()."</p>";
			}
		}

		public function __destruct() {
			mysqli_close($this->connection);
		}
	}

?>