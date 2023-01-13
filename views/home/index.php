<?php 
	global $mediaFiles;
	array_push($mediaFiles['css'], "media/css/home.css");

	//$blog = blog_model::getRecord('*', 'published = 1');
?>
<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<div class="content">
	<h1>Live a balanced life</h1><br/>
	
	<hr>
	<h2>List blogs</h2>
	<?php $blogs = $this->records;?>

	<div class="row">
		<div class="col-9">
			<?php if (count($blogs)) {?>
				<?php foreach($blogs as $blog) { ?>
					<div class="blog-card">
						<h2><?php echo $blog['title'] ?></h2>
						<h5><?php echo $blog['category'] . ', ' . $blog['created'] ?></h5>
						<div class="fakeimg"><?php echo $blog['image'] ?></div>
						<p><?php echo $blog['content'] ?></p>	
					</div>					
				<?php }	?>
			<?php } ?>
			
		</div>
		<div class="col-3">
			<div class="blog-card">
				<h2>About Me</h2>
				<div class="fakeimg">
					Image
				</div>
				<p>Some text about me in culpa qui officia deserunt mollit anim..</p>
			</div>
			<div class="blog-card">
				<h3>Popular Post</h3>
				<div class="fakeimg">Image</div><br>
				<div class="fakeimg">Image</div><br>
				<div class="fakeimg">Image</div>
			</div>
			<div class="blog-card">
				<h3>Follow Me</h3>
				<p>Some text..</p>
			</div>
		</div>
		</div>
</div>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
