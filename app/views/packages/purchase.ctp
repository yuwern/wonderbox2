
	<div class="purchase-conf">
<h1> Subscription Package details</h1>
<p><strong> Package Name : </strong><?php echo $this->Html->cText($package['Package']['name']); ?></p>
<p> <strong>Package Amount : </strong><?php echo  configure::read('site.currency'); ?> <?php echo $this->Html->cInt($package['Package']['cost']); ?>  </p>
<?php $this->Gateway->$action($gateway_options); ?>
</div>