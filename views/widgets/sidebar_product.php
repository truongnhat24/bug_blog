<?php 
	global $obMediaFiles;
	array_push($obMediaFiles['css'], "media/css/sidebar_product.css");
?>
<div class="list-group">
	<a href="#" class="list-group-item active">
		<h4 class="list-group-item-heading">Management products</h4>
	</a>
	<a href="<?php echo html_helpers::url(array('ctl'=>'products')); ?>" class="list-group-item">List all products</a>
	<a href="<?php echo html_helpers::url(array('ctl'=>'products', 'act'=>'add')); ?>" class="list-group-item">Add new products</a>
</div>
