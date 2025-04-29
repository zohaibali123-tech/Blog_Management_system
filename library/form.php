<?php
	
	require_once(__DIR__ . '/../model/dal_user.php');
	require_once(__DIR__ . '/../controller/bll_user.php');

	class Forms {
		public $action = NULL;
		public $method = NULL;

		public function __construct($action, $method) {
			$this->action = $action;
			$this->method = $method;
		}

		public function set_action($action) {
			$this->action = $action;
		}

		public function set_method($method) {
			$this->method = $method;
		}

		public function get_action() {
			return $this->action;
		}

		public function get_method() {
			return $this->method;
		}

		public function login_form() {
			?>
				<div align="center">
					<div class="card bg-transparent border-danger mb-3" style="max-width: 20rem;">
						<form action="<?= $this->action; ?>" method="<?= $this->get_method(); ?>">
							<div class="card-header bg-dark text-white border-danger">Login Here..!</div>
							<div class="card-body bg-dark bg-opacity-75 text-white">
								<table>
									<tr>
										<td><b>Email: </b></td>
										<td> <input type="email" name="email" class="form-control" placeholder="Enter Your Email..!"> </td>
									</tr>
									<tr>
										<td><b>Password: </b></td>
										<td> <input type="password" name="password" class="form-control" placeholder="Enter Your Password..!"> </td>
									</tr>
								</table>
							</div>
							<div class="card-footer bg-dark  text-white border-danger">
								<input type="submit" name="login_form" value="Login" class="btn btn-primary mb-2"><br>
								Don't have an account click <a href="register.php">Here</a>
							</div>
						</form>
					</div>
				</div>
			<?php
		}

		public function register_form($user_data = null) {
			$user_role 	= new BLL_User;

			$role = $user_role->role();

			if ($role && $role->num_rows) {
				
			?>
				<div align="center">
					<div class="card bg-transparent border-danger mb-3" style="max-width: 20rem;">
						<form action="<?= $this->action; ?>" method="<?= $this->get_method(); ?>">
							<div class="card-header bg-dark text-white border-danger"><?= isset($user_data) ? "Update User..!" : "Register Here..!"; ?></div>
							<div class="card-body bg-dark bg-opacity-75 text-white">
								<table>
									<tr>
										<td><b>Role: </b></td>
										<td>
											<select name="role" class="form-control">
												<option disabled <?= !isset($user_data) ? 'selected' : ''; ?>>--select--</option>
												<?php
													while ($data = mysqli_fetch_assoc($role)) {
														$selected = (isset($user_data) && $user_data['user_role_type_id'] == $data['user_role_type_id']) ? 'selected' : '';
														echo "<option value='{$data['user_role_type_id']}' {$selected}>{$data['user_role_type']}</option>";		
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>First Name: </b></td>
										<td> <input type="text" name="first_name" class="form-control" placeholder="Enter Your First Name..!" value="<?= isset($user_data) ? htmlspecialchars($user_data['first_name']) : ''; ?>"> </td>
									</tr>
									<tr>
										<td><b>Last Name: </b></td>
										<td> <input type="text" name="last_name" class="form-control" placeholder="Enter Your Last Name..!" value="<?= isset($user_data) ? htmlspecialchars($user_data['last_name']) : ''; ?>"> </td>
									</tr>
									<tr>
										<td><b>Email: </b></td>
										<td> <input type="email" name="email" class="form-control" placeholder="Enter Your Email..!" value="<?= isset($user_data) ? htmlspecialchars($user_data['email']) : ''; ?>"> </td>
									</tr>
									<tr>
										<td><b>Password: </b></td>
										<td> <input type="password" name="password" class="form-control" placeholder="Enter Your Password..!"> </td>
									</tr>
									<tr>
										<td><b>Phone Number: </b></td>
										<td> <input type="text" name="phone_number" class="form-control" placeholder="Enter Your Phone Number..!" value="<?= isset($user_data) ? htmlspecialchars($user_data['phone_number']) : ''; ?>"> </td>
									</tr>
								</table>
							</div>
							<div class="card-footer bg-dark  text-white border-danger">
								<?php if (isset($user_data)) { ?>
									<input type="hidden" name="user_id" value="<?= $user_data['user_id']; ?>">
									<input type="submit" name="update_user" value="Update" class="btn btn-primary mb-2">
								<?php } else { ?>
									<input type="submit" name="register_form" value="Register" class="btn btn-primary mb-2"><br>
									You have already register account login <a href="index.php">Here</a>
								<?php } ?>
							</div>
						</form>
					</div>
				</div>
			<?php
			}
		}

		public function post_form($post_data = NULL) {
			?>
				<div align="center">
					<div class="card bg-transparent border-danger mb-3" style="max-width: 20rem;">
						<form action="<?= $this->get_action(); ?>" method="<?= $this->get_method(); ?>">
							<div class="card-header bg-dark text-white border-danger"><?= isset($post_data) ? "Edit Post..!":"Add Post..!"; ?></div>
							<div class="card-body bg-dark bg-opacity-75 text-white">
								<table>
									<tr>
										<td><b>Title: </b></td>
										<td>
											<input type="text" name="title" class="form-control" placeholder="Enter Your Post Title..!" value="<?= isset($post_data) ? htmlspecialchars($post_data['title']) : '' ?>">
										</td>
									</tr>
									<tr>
										<td><b>Description: </b></td>
										<td> <textarea name="description" class="form-control" placeholder="Enter Your Post Description..!"><?= isset($post_data) ? htmlspecialchars($post_data['description']) : '' ?></textarea> </td>
									</tr>
								</table>
							</div>
							<div class="card-footer bg-dark  text-white border-danger">
								<?php
									if (isset($post_data)) { ?>
										<input type="hidden" name="post_id" value="<?= $post_data['post_id']; ?>">
										<input type="submit" name="edit_post" value="Update Post" class="btn btn-primary mb-2">
								<?php } else { ?>
										<input type="submit" name="add_post" value="Add Post" class="btn btn-primary mb-2">
								<?php } ?>
							</div>
						</form>
					</div>
				</div>
			<?php
		}
	}

?>