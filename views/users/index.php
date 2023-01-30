<?php 
	global $mediaFiles;
	array_push($mediaFiles['css'], "media/css/users.css");
?>

<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>

<div class="content">
	<h1>Qeo cam, </h1><br/>
	<!-- <?php echo $users['name']; ?> -->
	<?php $blogs = $this->records;?>

	<div class="row control-group">
		<div class="control-btn col-4 d-flex justify-content-center">
			<a href="<?php echo html_helpers::url(['ctl'=>'users', 'act'=>'user_profile']); ?>" class="link-btn d-flex align-items-center flex-column">
                <img class="img-btn" src="media/img/profile.png" alt="profile">
                <h3>My profile</h3>
            </a>
		</div>

		<div class="control-btn col-4 d-flex justify-content-center">
            <a href="#" class="link-btn d-flex align-items-center flex-column">
                <img class="img-btn" src="media/img/changepass.png" alt="pass">
                <h3>Change password</h3>
            </a>
		</div>

        <div class="control-btn col-4 d-flex justify-content-center">
            <a href="<?php echo html_helpers::url(['ctl'=>'blogs']); ?>" class="link-btn d-flex align-items-center flex-column">
                <img class="img-btn" src="media/img/writeblog.png" alt="add">
                <h3>My blogs</h3>
            </a>
		</div>
	</div>
</div>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
