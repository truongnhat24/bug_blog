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

	public function edit() 
	{
		$oldCmt = $this->comment->getRecord($_POST['comment_id']);
		$newCmt = $oldCmt;
		if ($_POST['content'] != $oldCmt['comment_content']) {
			$hisCmt = array('comment_id' => $oldCmt['id'], 'content' => $oldCmt['comment_content']);
			$this->comment->addHistoryComment($hisCmt);
			$newCmt['comment_content'] = $_POST['content'];
			$newCmt['status'] = 1;
			$this->comment->editRecord($_POST['comment_id'], $newCmt);			
			echo json_encode($this->comment->getRecord($_POST['comment_id']));
		}
	}

	public function delete($params)
	{
		$comment = $this->comment->getAllRecords("*", "blog_id =".$_POST['blog_id']);
		$delCmt = $this->comment->getRecord($params['comment_id']);
		$this->comment->delRecord($delCmt['id']);
		$this->like->delCmtRecord($_SESSION['auth']['id'], $delCmt['id']);
		foreach ($comment as $cmt) {
			if (str_contains($cmt['path'], $delCmt['path'])) {
				$this->comment->delRecord($cmt['id']);
				$this->like->delCmtRecord($_SESSION['auth']['id'], $cmt['id']);
			}
		}
	}
}