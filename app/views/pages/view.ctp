
<?php
if($this->request->params['pass'][0]=='how_it_works' || $this->request->params['pass'][0]=='about') { ?><div class="static-pages-block" id="">
	<?php echo $page['Page']['content']; ?></div>
<?php }
else if($this->request->params['pass'][0]=='earn-wonder-points') {
  echo $page['Page']['content']; 
} else { ?>
		<div id="inner-static"  class="static-page">
		<div class="head"><h1><?php echo $page['Page']['title']; ?></h1></div>
		<?php echo $page['Page']['content']; ?>
		</div>
<?php } ?>
