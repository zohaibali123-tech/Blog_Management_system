<?php

	class General {
		public static function site_title() {
			return "Blog Management System";
		}

		public static function site_header() {
			?>
				<div align="center">
					<h1><?= self::site_title(); ?></h1>
					<?php
						if (isset($_SESSION['user'])) {
							?>
								<p class="badge text-bg-info py-3" style='float: right;'><b>Welcome (<?php 
									if (isset($_SESSION['user']) && $_SESSION['user']['user_role_type_id'] == 1) {
										echo "Admin";
									} elseif (isset($_SESSION['user']) && $_SESSION['user']['user_role_type_id'] == 2) {
										echo "Editor";
									} elseif (isset($_SESSION['user']) && $_SESSION['user']['user_role_type_id'] == 3) {
										echo "User";
									}
								?>): </b><?= $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?> &nbsp; | &nbsp;<a class="btn btn-primary" href="logout.php">Logout</a></p>
							<?php
						}
					?>
					<hr style="clear: both;" />
				</div>
			<?php
		}

		public static function admin_menu() {
			?>
				<ul class="nav justify-content-center">
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="manage_post.php">Manage Post</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="manage_user.php">Manage User</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="view_profile.php">View Profile</a>
					</li>
				</ul>
			<?php
		}

		public static function editor_menu() {
			?>
				<ul class="nav justify-content-center">
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="manage_post.php">Manage Post</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="view_profile.php">View Profile</a>
					</li>
				</ul>
			<?php
		}

		public static function user_menu() {
			?>
				<ul class="nav justify-content-center">
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-light" href="view_profile.php">View Profile</a>
					</li>
				</ul>

			<?php
		}
	}

?>