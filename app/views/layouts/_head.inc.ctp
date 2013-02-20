<?php
	$this->Html->css('reset', null, array('inline' => false));
	$this->Html->css('style', null, array('inline' => false));
	$this->Html->css('global', null, array('inline' => false));
	$this->Html->css('anythingslider', null, array('inline' => false));
	$this->Html->css('chromestyle', null, array('inline' => false));
	$this->Html->css('jquery.countdown', null, array('inline' => false));
	$this->Html->css('jquery-ui-1.7.1.custom', null, array('inline' => false));
	$this->Javascript->codeBlock('var cfg = ' . $this->Javascript->object($js_vars_for_layout) , array('inline' => false));
	$this->Javascript->link('libs/jquery.min', false);
	$this->Javascript->link('libs/jquery.livequery', false);
	$this->Javascript->link('libs/jquery.easing.min', false);
	$this->Javascript->link('libs/jquery-ui-1.7.2.custom.min', false);
	$this->Javascript->link('libs/slides.min.jquery', false); 
	$this->Javascript->link('libs/jquery.countdown', false);
	$this->Javascript->link('libs/jquery.anythingslider', false);
	$this->Javascript->link('libs/chrome', false);
	$this->Javascript->link('frontend_common', false);
?>

