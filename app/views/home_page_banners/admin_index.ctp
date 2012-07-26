<?php /* SVN: $Id: $ */ ?>
<?php 
	if(!empty($this->request->params['isAjax'])):
		echo $this->element('flash_message');
	endif;
?>
<div class="homePageBanners index">
<h2><?php echo __l('Home Page Banners');?></h2>
  <div class="clearfix add-block1"><?php echo $this->Html->link(__l('Add'), array('controller' => 'home_page_banners', 'action' => 'add'), array('class' => 'add','title' => __l('Add'))); ?></div>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr> 
       <th class="actions"><?php echo __l('Action');?></th>
       <th class="actions"><?php echo __l('Image');?></th>
        <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Name'),'name');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Active');?></div></th>
     </tr>
<?php
if (!empty($homePageBanners)):

$i = 0;
foreach ($homePageBanners as $homePageBanner):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td class="actions">
            <span><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $homePageBanner['HomePageBanner']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $homePageBanner['HomePageBanner']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
           </td>
          <td> <?php echo $this->Html->showImage('HomePageBanner', (!empty($homePageBanner['Attachment']) ? $homePageBanner['Attachment'] : ''), array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageBanner['HomePageBanner']['title'], false)), 'title' => $this->Html->cText($homePageBanner['HomePageBanner']['title'], false)));?>     </td>
          <td> <?php echo $this->Html->cText($homePageBanner['HomePageBanner']['title']);?> </td>
		  <td> <?php echo $this->Html->cBool($homePageBanner['HomePageBanner']['is_active']);?> </td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="3" class="notice"><?php echo __l('No Home Page Banners available');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($homePageBanners)) {?>
     <div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                    </div>
<?php } ?>
</div>