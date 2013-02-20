<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/',true); ?>css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/',true); ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/',true); ?>css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/',true); ?>css/anythingslider.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/',true); ?>css/chromestyle.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/',true); ?>css/jquery.countdown.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/',true); ?>css/jquery-ui-1.7.1.custom.css" />
<?php 	$this->Javascript->codeBlock('var cfg = ' . $this->Javascript->object($js_vars_for_layout) , array('inline' => false)); ?>
<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/jquery.livequery.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/jquery.easing.min.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/slides.min.jquery.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/jquery.countdown.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/jquery.anythingslider.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/libs/chrome.js"></script>
	<script type="text/javascript" src="<?php echo Router::url('/',true); ?>js/frontend_common.js"></script>
<?php

//	$this->Html->css('reset', null, array('inline' => false));
//	$this->Html->css('style', null, array('inline' => false));
//	$this->Html->css('global', null, array('inline' => false));
//	$this->Html->css('anythingslider', null, array('inline' => false));
//	$this->Html->css('chromestyle', null, array('inline' => false));
//	$this->Html->css('jquery.countdown', null, array('inline' => false));
//	$this->Html->css('jquery-ui-1.7.1.custom', null, array('inline' => false));
//	$this->Javascript->link('libs/jquery.min', false);
//	$this->Javascript->link('libs/jquery.livequery', false);
//	$this->Javascript->link('libs/jquery.easing.min', false);
//	$this->Javascript->link('libs/jquery-ui-1.7.2.custom.min', false);
//	$this->Javascript->link('libs/slides.min.jquery', false); 
//	$this->Javascript->link('libs/jquery.countdown', false);
//	$this->Javascript->link('libs/jquery.anythingslider', false);
//	$this->Javascript->link('libs/chrome', false);
//	$this->Javascript->link('frontend_common', false);
?>

