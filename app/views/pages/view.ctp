
<?php
if($this->request->params['pass'][0]=='how_it_works') { ?><div class="static-pages-block" id="">
	<?php echo $page['Page']['content']; ?></div>
<?php }else { ?>
		<div id="inner-static">
		<h2><?php echo $page['Page']['title']; ?></h2>
		<?php echo $page['Page']['content']; ?>
		</div>
<?php } ?>
