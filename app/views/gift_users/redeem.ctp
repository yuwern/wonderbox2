<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
	<?php endif; ?> 
<div class="giftUsers form">
	<h2> <?php echo __l('Redeem a wonderbox');?></h2>
<?php echo $this->Form->create('GiftUser', array('action'=>'redeem','class' => 'normal'));?>
		<?php echo $this->Form->input('coupon_code'); 	?>
<?php echo $this->Form->end(__l('Redeem'));?>
</div>

	<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>
	