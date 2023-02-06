<?php
global $mediaFiles;
array_push($mediaFiles['css'], "media/css/blogs.css");
array_push($mediaFiles['css'], "media/css/view_blog.css");
array_push($mediaFiles['css'], RootREL . 'media/fontawesome/css/all.css');
?>

<?php include_once 'views/layout/' . $this->layout . 'header.php'; ?>
<?php if (isset($_SESSION['auth'])) {

    $params = (isset($this->records)) ? array('id' => $this->records['id']) : ''; ?>
    <?php echo $this->records['content']; ?>
    <section class="content-item mt-3" id="comments">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <form>
                        <h3>Comment</h3>
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-3 col-lg-2">
                                    <img class="img-responsive" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <textarea class="form-control" id="message" placeholder="Your comment" required=""></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-custom-auth text-light">Submit</button>
                        </div>
                    </form>

                    <h3>4 Comments</h3>

                    <!-- COMMENT 1 - START -->
                    <div class="media d-flex flex-row">
                        <a class="pull-left" href="#"><img class="w-100" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></a>
                        <div class="media-body">
                            <h4 class="media-heading">John Doe</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            
                            <div class="d-flex flex-row justify-content-between">
                                <ul class="list-unstyled list-inline media-detail d-flex">
                                    <li><i class="fa fa-calendar"></i>24/05/2023</li>
                                    <li><i class="fa fa-thumbs-up"></i>69</li>
                                </ul>
                                <ul class="list-unstyled list-inline media-detail d-flex">
                                    <li class=""><a href="">Like</a></li>
                                    <li class=""><a href="">Reply</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- COMMENT 1 - END -->

                </div>
            </div>
        </div>
    </section>

<?php } else header("Location: " . html_helpers::url(array('ctl' => 'users', 'act' => 'login'))) ?>

<?php include_once 'views/layout/' . $this->layout . 'footer.php'; ?>