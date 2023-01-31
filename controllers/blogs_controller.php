<?php
class blogs_controller extends main_controller {

	public function index() {
		$this->checkAuth();
	}

	public function create() {
		$user = user_model::getInstance();
		$user->createTable();
		
		$activity = activity_model::getInstance();
		$activity->createTable();
		
		$this->blogs = $user->getAllTables();
		$this->display();
	}
	
	// public function getfields($params) {
	// 	$this->blog  = $params['blog'];
	// 	$main = main_model::getInstance();
	// 	$this->fields = $main->getAllFields($this->blog);
	// 	$this->display(['act'=>'fields']);
	// }

	public function add_blog() {
		$this->display();
	}

	public function getBlogs() {
		$blog = new blog_model();
	}

	public function createSubmit() {
		if(isset($_POST['add_blog'])) {
			var_dump($_FILES); exit();
			var_dump($_POST);exit();
			$blogData = $_POST['data'][$this->controller];
			var_dump($blogData); exit();
			if(!empty($userData['username']))  {
				$user = user_model::getInstance();
				if ($user->addRecord($userData)){
					header( "Location: ".html_helpers::url(array('ctl'=>'users', 'act'=>'login')));
				}
			}
		}
	}
}
?>
