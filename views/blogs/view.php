<?php
global $mediaFiles;
array_push($mediaFiles['css'], "media/css/blogs.css");
array_push($mediaFiles['css'], "media/css/view_blog.css");
array_push($mediaFiles['css'], RootREL . 'media/fontawesome/css/all.css');
?>

<?php include_once 'views/layout/' . $this->layout . 'header.php'; ?>
<?php if (isset($_SESSION['auth'])) {
    $data = $_SESSION['auth'];
    $params = (isset($this->records)) ? array('id' => $this->records['id']) : ''; ?>
    <?php echo $this->records['content']; ?>
    <section class="content-item mt-3" id="comments">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 comment-contain">
                    <form name="comment-form" class="comment-form">
                        <h3>Comment</h3>
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-3 col-lg-2">
                                    <img class="img-responsive" src="media/upload/users/<?php echo $_SESSION['auth']['image'] ?>">
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <textarea class="form-control" id="message" placeholder="Your comment" required></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <div class="d-flex justify-content-end">
                            <button name="comment" type="submit" class="btn btn-custom-auth text-light comment-btn" alt="<?php echo html_helpers::url(
                                                                                                                                array(
                                                                                                                                    'ctl' => 'comments',
                                                                                                                                    'act' => 'add',
                                                                                                                                    'params' => $params
                                                                                                                                )
                                                                                                                            ); ?>">Comment</button>
                        </div>
                    </form>

                    <h3><?php echo count($this->commentRecords);?> Comments</h3>

                    <!-- COMMENT - START -->
                    <div class="comment-ances">
                        <?php foreach ($this->commentRecords as $data) { ?>
                            <div alt="<?php echo $data['id']; ?>" class="media d-flex flex-column <?php if(substr_count($data['path'], '.') == 1) echo 'ms-5'; elseif (substr_count($data['path'], '.') > 1) echo 'ms-6'?>">
                                <div class="d-flex flex-row">
                                    <a class="pull-left" href="#"><img class="w-75 h-75 rounded-circle" src="media/upload/users/<?php echo $data['image'] ?>"></a>
                                    <div class="media-body flex-grow-1">
                                        <h4 class="media-heading"><?php echo $data['name']; ?></h4>
                                        <p><?php echo $data['comment_content'] ?></p>
        
                                        <div class="d-flex flex-row justify-content-between">
                                            <ul class="list-unstyled list-inline media-detail d-flex">
                                                <li>
                                                    <i class="fa fa-calendar"></i>
                                                    <span>
                                                        <?php echo $data['created'] ?>
                                                    </span>
                                                </li>
                                                <li class="like-group <?php if (in_array($data['id'], $this->likeRecords)) {
                                                                            echo "liked";
                                                                        } ?>" alt="<?php echo $data['id'] ?>">
                                                    <i class="fa fa-thumbs-up like-icon"></i>
                                                    <span class="like-count" alt="<?php echo $data['id'] ?>">
                                                        <?php echo $data['like_count']; ?>
                                                    </span>
                                                </li>
                                            </ul>
                                            <ul class="list-unstyled list-inline media-detail d-flex">
                                                <li>
                                                    <a class="like-btn" href="" value="<?php echo $data['id']; ?>" alt="<?php $params = array('comment_id' => $data['id']);
                                                                                                                        echo html_helpers::url(
                                                                                                                            array(
                                                                                                                                'ctl' => 'likes',
                                                                                                                                'act' => 'add',
                                                                                                                                'params' => $params
                                                                                                                            )
                                                                                                                        ); ?>">
                                                        Like
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="reply-btn" value="<?php echo $data['id']; ?>">
                                                        Reply
                                                    </a>
                                                </li>
                                                <?php if ($_SESSION['auth']['id'] == $data['user_id']) { ?>
                                                    <li>
                                                        <a class="delete-btn" href="" value="<?php echo $data['id']; ?>" alt="<?php $params = array('comment_id' => $data['id']);
                                                                                                                            echo html_helpers::url(
                                                                                                                                array(
                                                                                                                                    'ctl' => 'comments',
                                                                                                                                    'act' => 'delete',
                                                                                                                                    'params' => $params
                                                                                                                                    )
                                                                                                                                ); ?>">
                                                            Delete
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="edit-btn" value="<?php echo $data['id']; ?>" >
                                                            Edit
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="reply-comment" alt="<?php echo $data['id'] ?>">
                                    <form name="reply-form" class="reply-form ps-5 mt-3">
                                        <h3 class="ps-4">Reply</h3>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-2">
                                                    <div class="img-reply-contain rounded-circle">
                                                        <img class="img-responsive w-100" src="media/upload/users/<?php echo $_SESSION['auth']['image'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                                    <textarea class="reply-content form-control" alt="<?php echo $data['id'] ?>"  placeholder="Your comment" required></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="d-flex justify-content-end">
                                            <button name="reply" type="button" class="btn btn-custom-auth text-light reply-button" value="<?php echo $data['id'] ?>" alt="<?php echo html_helpers::url(
                                                                                                                                                                                array(
                                                                                                                                                                                    'ctl' => 'comments',
                                                                                                                                                                                    'act' => 'reply'
                                                                                                                                                                                )
                                                                                                                                                                            ); ?>">Reply</button>
                                        </div>
                                    </form>
                                </div>
                                <?php if ($_SESSION['auth']['id'] == $data['user_id']) { ?>
                                    <div class="edit-comment" alt="<?php echo $data['id'] ?>">
                                        <form name="edit-form" class="edit-form ps-5 mt-3">
                                            <h3 class="ps-4">Edit</h3>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-3 col-lg-2">
                                                        <img class="img-responsive w-50 h-50 rounded-circle" src="media/upload/users/<?php echo $_SESSION['auth']['image'] ?>">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                                        <textarea class="edit-content form-control" alt="<?php echo $data['id'] ?>"  placeholder="Your comment" required></textarea>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="d-flex justify-content-end">
                                                <button name="edit" type="button" class="btn btn-custom-auth text-light edit-button" value="<?php echo $data['id'] ?>" alt="<?php $params = array('comment_id' => $data['id']);
                                                                                                                                                                                echo html_helpers::url(
                                                                                                                                                                                    array(
                                                                                                                                                                                        'ctl' => 'comments',
                                                                                                                                                                                        'act' => 'edit',
                                                                                                                                                                                        )
                                                                                                                                                                                    ); ?>">Edit</button>
                                            </div>
                                        </form>
                                    </div>                                                    
                                <?php } ?>
                                <div class="comment-reply ps-5" alt="<?php echo $data['id'] ?>">						
						        </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- COMMENT - END -->

                </div>
            </div>
        </div>
    </section>
    <script>
        // window.blog_id = "{{$blog->id}}";
        var auth_img = "<?php echo $_SESSION['auth']['image'] ?>",
            blog_id = "<?php echo $this->records['id']?> "
            auth_name = "<?php echo $_SESSION['auth']['name'] ?>";
            // link_reply_submit = "",
            // link_comment_submit = ""
            // link = (ctl, act, params) => { 
            //     return ""
            // }
    </script>
<?php } else header("Location: " . html_helpers::url(array('ctl' => 'users', 'act' => 'login'))) ?>

<?php global $mediaFiles; ?>
<?php array_push($mediaFiles['js'], RootREL . "media/js/jquery.min.js"); ?>
<?php array_push($mediaFiles['js'], RootREL . "media/js/blogs.js"); ?>
<?php include_once 'views/layout/' . $this->layout . 'footer.php'; ?>