<?php
if (!empty($homePageBanners)):
$i = 0;
foreach ($homePageBanners as $homePageBanner):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
<?php echo $this->Html->showImage('HomePageBanner', (!empty($homePageBanner['Attachment']) ? $homePageBanner['Attachment'] : ''), array('dimension' => 'home_banner_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageBanner['HomePageBanner']['title'], false)), 'title' => $this->Html->cText($homePageBanner['HomePageBanner']['title'], false)));?>
<?php
    endforeach;
else:
?>
<p class="notice"><?php echo __l('No Home Page Banners available');?></p>
<?php
endif; ?>
