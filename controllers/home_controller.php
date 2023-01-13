<?php
class home_controller extends main_controller {
	public function index() {
		$blog = blog_model::getInstance();
		$this->records = $blog->getAllRecords();
		//var_dump($this); exit();
		//echo '<pre>' , var_dump($this->records); exit(); '</pre>';
		$this->display();
	}
}
?>
