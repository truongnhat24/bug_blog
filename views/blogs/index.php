<?php 
	global $mediaFiles;
	array_push($mediaFiles['css'], "media/css/blogs.css");
?>

<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<div class="content">
	<h1>List blogs</h1>
	<hr>
	<?php $userblogs = [];
		$userblogs = $this->records;
	?>
	<?php if(count($userblogs)) { ?>
		<ol>
		<?php foreach($this->blogs as $blog) { ?>
			<li><a href="<?php echo html_helpers::url(['ctl'=>'blogs', 'act'=>'getfields', 'params'=>['blog'=>$blog]]); ?>"><?php echo $blog ?></a></li>
			<?php if($blog == 'users' || $blog == 'activity_user') array_push($usertables,$blog); ?>
		<?php } ?>
		</ol>
		<?php if(!count($usertables)) { ?>
			<p> There are no users & activity_user tables added, please <a href="<?php echo html_helpers::url(['ctl'=>'blogs', 'act'=>'create']); ?>">click here</a> to add 2 tables <strong>users</strong> & <strong>user_activity</strong> </p>
		<?php } ?>

	<?php } else {?>
		<p> There are no table added, please <a href="<?php echo html_helpers::url(['ctl'=>'blogs', 'act'=>'create']); ?>">click here</a> to add 2 tables <strong>users</strong> & <strong>user_activity</strong> </p>
	<?php }; ?>
	<div class="row">
		<div class="col-12 col-lg-9">
			<div class="d-flex"> 
				<a class="user-avatar me-5">
					<img src="media/img/favicon.png" alt="avatar">					
				</a>
				<div class="col-12 col-md-6">
					<div class="blog-user d-flex justify-content-between">
						<p>By <a href="#">james smith</a></p>
						<span>22-12-2022</span>				
					</div>
					
					<div>
						<h4><a href="#" class="post-headline">Party people in the house</a></h4>
					</div>
					
					<ul class="status d-flex">
						<li class="d-flex me-4">
							<a class="like-icon" href="#">
								<img src="media/img/like.png" alt="like">
							</a>
							<span>1</span>
						</li>
						<li class="d-flex">
							<a href="#">
								<img src="media/img/comment.png" alt="comment">
							</a>
							<a href="#">
								<p>3 comments</p>
							</a>
						</li>
					</ul>
				</div>				
			</div>
			<hr>		
		</div>
	</div>
</div>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
