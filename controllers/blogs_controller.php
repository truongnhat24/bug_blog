<?php
class blogs_controller extends main_controller {
	public function index() {
		$user = user_model::getInstance();
		$this->blogs = $user->getAllTables();
		$this->display();
	}
	public function create() {
		$user = user_model::getInstance();
		$user->createTable();
		
		$activity = activity_model::getInstance();
		$activity->createTable();
		
		$this->blogs = $user->getAllTables();
		$this->display();
	}
	public function getfields($params) {
		$this->blog  = $params['blog'];
		$main = main_model::getInstance();
		$this->fields = $main->getAllFields($this->blog);
		$this->display(['act'=>'fields']);
	}
}
?>
