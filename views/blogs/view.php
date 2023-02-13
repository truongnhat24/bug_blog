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
                    <form name="comment-form" class="comment-form" action="<?php echo html_helpers::url(
                                                                                array(
                                                                                    'ctl' => 'comments',
                                                                                    'act' => 'add',
                                                                                    'params' => $params
                                                                                )
                                                                            ); ?>">
                        <h3>Comment</h3>
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-3 col-lg-2">
                                    <img class="img-responsive" src="media/upload/users/<?php echo $data['image'] ?>">
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

                    <h3><?php echo count($this->commentRecords); ?> Comments</h3>

                    <!-- COMMENT 1 - START -->
                    <?php foreach ($this->commentRecords as $data) { ?>
                        <div class="media d-flex flex-row">
                            <a class="pull-left" href="#"><img class="w-75 rounded-circle" src="media/upload/users/<?php echo $data['image'] ?>" alt=""></a>
                            <div class="media-body flex-grow-1">
                                <h4 class="media-heading"><?php echo $data['name']; ?></h4>
                                <p><?php echo $data['comment_content'] ?></p>

                                <div class="d-flex flex-row justify-content-between">
                                    <ul class="list-unstyled list-inline media-detail d-flex">
                                        <li><i class="fa fa-calendar"></i><?php echo $data['created'] ?></li>
                                        <li><i class="fa fa-thumbs-up like_icon"></i><?php echo $data['like_count'] ?></li>
                                    </ul>
                                    <ul class="list-unstyled list-inline media-detail d-flex">
                                        <li><a class="like-btn" value="<?php echo $data['id']; ?>" alt="<?php $params = array('comment_id' => $data['id']) ; echo html_helpers::url(
                                                                                                            array(
                                                                                                                'ctl' => 'likes',
                                                                                                                'act' => 'add',
                                                                                                                'params' => $params
                                                                                                            )
                                                                                                        ); ?>">Like</a></li>
                                        <li><a class="reply-btn" href="">Reply</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- COMMENT 1 - END -->

                </div>
            </div>
        </div>
    </section>
    <script>
        // window.blog_id = "{{$blog->id}}";
        var auth_img = "<?php echo $_SESSION['auth']['image'] ?>",
            auth_name = "<?php echo $_SESSION['auth']['name'] ?>";
    </script>
<?php } else header("Location: " . html_helpers::url(array('ctl' => 'users', 'act' => 'login'))) ?>

<?php global $mediaFiles; ?>
<?php array_push($mediaFiles['js'], RootREL . "media/js/jquery.min.js"); ?>
<?php array_push($mediaFiles['js'], RootREL . "media/js/blogs.js"); ?>
<?php include_once 'views/layout/' . $this->layout . 'footer.php'; ?>