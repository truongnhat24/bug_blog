<?php
class comments_controller extends main_controller
{
	protected comment_model $comment;
	protected like_model $like;
	public function __construct()
	{
		$this->comment = comment_model::getInstance();
		$this->like = like_model::getInstance();
		parent::__construct();
	}

	public function getAllRecords ($fields = "*", $options = null) {

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
		$comment = $this->comment->getAllRecords("*", "blog_id =".$_POST['blog_id']);
		$delCmt = $this->comment->getRecord($params['comment_id']);
		$this->comment->delRecord($delCmt['id']);
		$this->like->delRecord($delCmt['id']);
		foreach ($comment as $cmt) {
			if (str_contains($cmt['path'], $delCmt['path'])) {
				$this->comment->delRecord($cmt['id']);
				$this->like->delRecord($cmt['id']);
			}
		}
	}
}