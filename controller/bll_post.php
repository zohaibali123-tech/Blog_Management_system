<?php

	require_once("../../model/dal_post.php");

	class BLL_Post extends DAL_Post {
		private $title 			= NULL;
		private $description 	= NULL;
		private $added_by 		= NULL;
		private $added_on 		= NULL;
		private $post_result 	= NULL;

		public function set_title($title) {
			$this->title = $title;
		}

		public function set_description($description) {
			$this->description = $description;
		}

		public function set_added_by($added_by) {
			$this->added_by = $added_by;
		}

		public function set_added_on($added_on) {
			$this->added_on = $added_on;
		}

		public function get_title() {
			return $this->title;
		}

		public function get_description() {
			return $this->description;
		}

		public function get_added_by() {
			return $this->added_by;
		}

		public function get_added_on() {
			return $this->added_on;
		}

		public function show_all_posts() {
			$this->post_result = $this->get_all_posts();

			return $this->post_result;
		}

		public function add_post($title, $description, $added_by) {
			$this->post_result = $this->insert_post($title, $description, $added_by);

			return $this->post_result;
		}

		public function edit_post($post_id, $title, $description) {
			$this->post_result = $this->update_post($post_id, $title, $description);

			return $this->post_result;
		}

		public function delete_post($post_id) {
			$this->post_result = $this->del_post($post_id);

			return $this->post_result;
		}
	}

?>