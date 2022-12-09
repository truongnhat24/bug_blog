<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<div class="content">
	<h1>List blogs</h1>
	<hr>
	<?php $usertables = [];  ?>
	<?php if(count($this->blogs)) { ?>
		<ol>
		<?php foreach($this->blogs as $blog) { ?>
			<li><a href="<?php echo html_helpers::url(['ctl'=>'blogs', 'act'=>'getfields', 'params'=>['blog'=>$blog]]); ?>"><?php echo $blog ?></a></li>
			<?php if($blog == 'users' || $blog == 'activity_user') array_push($usertables,$blog);	; ?>
		<?php } ?>
		</ol>
		<?php if(!count($usertables)) { ?>
			<p> There are no users & activity_user tables added, please <a href="<?php echo html_helpers::url(['ctl'=>'blogs', 'act'=>'create']); ?>">click here</a> to add 2 tables <strong>users</strong> & <strong>user_activity</strong> </p>
		<?php } ?>
	<?php } else {?>
		<p> There are no table added, please <a href="<?php echo html_helpers::url(['ctl'=>'blogs', 'act'=>'create']); ?>">click here</a> to add 2 tables <strong>users</strong> & <strong>user_activity</strong> </p>
	<?php } ?>
</div>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
