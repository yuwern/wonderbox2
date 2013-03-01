<?php /* SVN: $Id: $ */ ?>
<div class="productRedemptionUsers view">
<h2><?php echo __l('Product Redemption User');?></h2>
	<dl class="list"><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Id');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($productRedemptionUser['ProductRedemptionUser']['id']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Created');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDateTime($productRedemptionUser['ProductRedemptionUser']['created']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Modified');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDateTime($productRedemptionUser['ProductRedemptionUser']['modified']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Product Redemption');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($productRedemptionUser['ProductRedemption']['name']), array('controller' => 'product_redemptions', 'action' => 'view', $productRedemptionUser['ProductRedemption']['slug']), array('escape' => false));?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('User');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($productRedemptionUser['User']['username']), array('controller' => 'users', 'action' => 'view', $productRedemptionUser['User']['username']), array('escape' => false));?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Is Redeem');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cBool($productRedemptionUser['ProductRedemptionUser']['is_redeem']);?></dd>
	</dl>
</div>