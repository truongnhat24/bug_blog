<?php
class comments_controller extends main_controller
{
	protected comment_model $comment;
	public function __construct()
	{
		$this->comment = comment_model::getInstance();
		parent::__construct();
	}

	public function add($params)
	{
		if (isset($_POST['content'])) {
			$id = $_SESSION['auth']['id'];
			$commentData = array('user_id' => $id, 'blog_id' => $params['id'], 'comment_content' => $_POST['content']);
			if (!empty($commentData['comment_content'])) {
				echo json_encode($this->comment->addRecord($commentData));
			}
		}
	}

	public function reply()
	{
		if (isset($_POST['content'])) {
			$id = $_SESSION['auth']['id'];
			$commentData = array('user_id' => $id, 'blog_id' => $_POST['blog_id'], 'comment_content' => $_POST['content']);
			if (!empty($commentData['comment_content'])) {
				echo json_encode($this->comment->addReplyRecord($_POST['parentId'], $commentData));
			}
		}
	}

	public function delete($params)
	{
		echo "<pre>";
		var_dump($params);exit();
	}
}