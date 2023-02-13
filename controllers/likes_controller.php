<?php
class likes_controller extends main_controller
{
    protected like_model $like;
    public function __construct()
    {
        $this->like = like_model::getInstance();
        parent::__construct();
    }

    public function add($params)
    {
        $id = $_SESSION['auth']['id'];
        $likeData = array('user_id' => $id, 'type_id' => $params['comment_id'], 'type' => 'comment');
        $this->like->addRecord($likeData);
        
    }
}
