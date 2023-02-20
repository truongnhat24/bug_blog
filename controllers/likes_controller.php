<?php
class likes_controller extends main_controller
{
    protected like_model $like;
    protected comment_model $comment;
    public function __construct()
    {
        $this->like = like_model::getInstance();
        $this->comment = comment_model::getInstance();
        parent::__construct();
    }

    public function add($params)
    {
        $id = $_SESSION['auth']['id'];
        $likeData = array('user_id' => $id, 'type_id' => $params['comment_id'], 'type' => 'comment');
        $commentData = $this->comment->getRecord($params['comment_id']);
        $checkData = $this->like->getAllRecords();
        foreach ($checkData as $data) {
            if ($data['user_id'] == $likeData['user_id'] and $data['type_id'] == $likeData['type_id'] and $data['type'] == $likeData['type']) {
                $commentData['like_count'] -= 1;
                $this->comment->editRecord($commentData['id'], $commentData);
                echo json_encode($commentData['like_count']);
                return $this->like->delRecord($data['id']);
            }
        }
        $commentData['like_count'] += 1;
        $this->comment->editRecord($commentData['id'], $commentData);
        echo json_encode($commentData['like_count']);
        return $this->like->addRecord($likeData);
    }

    public function checkLike($id, $comment_id)
    {
        $likeData = $this->like->getAllRecords();
        foreach ($likeData as $data) {
            if ($data['user_id'] == $id and $data['type_id'] == $comment_id) {
                return true;
            }
        }
        return false;
    }
}
