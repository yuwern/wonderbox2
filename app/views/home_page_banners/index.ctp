

			<div class="banner">
				<div class="bannerslide" id='js-gallery'><?php
if (!empty($homePageBanners)):

$i = 0;
foreach ($homePageBanners as $homePageBanner):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
<?php echo $this->Html->link($this->Html->showImage('HomePageBanner', (!empty($homePageBanner['Attachment']) ? $homePageBanner['Attachment'] : ''), array('dimension' => 'home_banner_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageBanner['HomePageBanner']['title'], false)), 'title' => $this->Html->cText($homePageBanner['HomePageBanner']['title'], false))),array('controller' => 'pages', 'action' => 'view', 'how_it_works', 'admin' => false),array('title'=>$homePageBanner['HomePageBanner']['title'],'escape' =>false));?>
<?php
    endforeach;
else:
?>
<p class="notice"><?php echo __l('No Home Page Banners available');?></p>
<?php
endif; ?></div>
