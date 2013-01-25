<?php /* SVN: $Id: $ */ ?>
<div class="giftUsers view">
<h2><?php echo __l('Gift User');?></h2>
	<dl class="list"><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Id');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($giftUser['GiftUser']['id']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Created');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDateTime($giftUser['GiftUser']['created']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Modified');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDateTime($giftUser['GiftUser']['modified']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('User');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($giftUser['User']['username']), array('controller' => 'users', 'action' => 'view', $giftUser['User']['username']), array('escape' => false));?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Amount');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cCurrency($giftUser['GiftUser']['amount']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('From');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($giftUser['GiftUser']['from']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Friend Name');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($giftUser['GiftUser']['friend_name']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Friend Mail');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($giftUser['GiftUser']['friend_mail']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Message');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($giftUser['GiftUser']['message']);?></dd>
	</dl>
</div>