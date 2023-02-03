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

<?php } else header("Location: " . html_helpers::url(array('ctl' => 'users', 'act' => 'login'))) ?>

<?php include_once 'views/layout/' . $this->layout . 'footer.php'; ?>