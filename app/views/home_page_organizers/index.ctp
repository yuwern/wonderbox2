<?php
if (!empty($homePageOrganizers)):

$i = 0;
foreach ($homePageOrganizers as $homePageOrganizer):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
  <div class="borderimg2"><?php echo $this->Html->showImage('HomePageOrganizer', (!empty($homePageOrganizer['Attachment']) ? $homePageOrganizer['Attachment'] : ''), array('dimension' => 'small_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)), 'title' => $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)));?></div>
	<?php echo $this->Html->cText($homePageOrganizer['HomePageOrganizer']['content']);?>
	<a href="http://staging.wonderbox.com.my/page/October2012">Click to see more</a>

<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Home Page Organizers available');?></p>
	</li>
<?php
endif;
?>