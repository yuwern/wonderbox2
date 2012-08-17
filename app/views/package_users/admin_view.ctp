<?php /* SVN: $Id: $ */ ?>
<div class="packageUsers view">
<h2><?php echo __l('Package User');?></h2>
	<dl class="list"><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Id');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($packageUser['PackageUser']['id']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Created');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDateTime($packageUser['PackageUser']['created']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Modified');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDateTime($packageUser['PackageUser']['modified']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('User');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($packageUser['User']['username']), array('controller' => 'users', 'action' => 'view', $packageUser['User']['username']), array('escape' => false));?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Package');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($packageUser['Package']['name']), array('controller' => 'packages', 'action' => 'view', $packageUser['Package']['slug']), array('escape' => false));?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Start Date');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDate($packageUser['PackageUser']['start_date']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('End Date');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDate($packageUser['PackageUser']['end_date']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Is Paid');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cBool($packageUser['PackageUser']['is_paid']);?></dd>
	</dl>
</div>