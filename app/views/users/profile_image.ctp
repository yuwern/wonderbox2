<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
<?php endif; ?>

<div class="dashboard-block">
<h1><?php echo __l('My Profile'); ?></h1>
<?php echo $this->Form->create('User', array('action' => 'profile_image', 'class' => 'normal-form',  'enctype' => 'multipart/form-data'));
      echo $this->Form->input('User.id', array('type' => 'hidden'));
	 echo $this->Form->input('User.profile_image_id', array('type'=>'hidden','value'=> 3)); ?>
<div class="clearfix avatar-options">
		<?php if(!empty($this->request->data['UserAvatar']) && !empty($this->request->data['UserAvatar']['id'])){
			echo $this->Html->showImage('UserAvatar', $this->request->data['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($this->request->data['User']['username'], false)),'class' => 'upload-avatar', 'title' => $this->Html->cText($this->request->data['User']['username'], false)), null, array('inline' => false));
			}
		?>
	   <h4><?php echo __l('Upload Image'); ?></h4>
		<?php echo $this->Form->input('UserAvatar.filename', array('type' => 'file','size' => '20', 'label' => false,'class' =>'browse-field')); ?>
		
</div><br/>

<?php echo $this->Form->submit(__l('Update profile'),array('class'=>'btn5'));?>
<?php echo $this->Form->end(); ?>
</div>
<?php if(empty($this->request->params['isAjax']) ): ?>	
           </div>    
        </div>	
<?php endif; ?>