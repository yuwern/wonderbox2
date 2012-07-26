<div class="static-pages-block">
<?php
if($this->request->params['pass'][0]=='how_it_works') { ?>
	<?php echo $page['Page']['content']; ?>
<?php }else { ?>
		<h2><?php echo $page['Page']['title']; ?></h2>
		<?php echo $page['Page']['content']; ?>
<?php } ?>
</div>