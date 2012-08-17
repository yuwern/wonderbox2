<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="paypalTransactionLogs index">
<h2><?php echo __l('Paypal Transaction Logs');?></h2>
<?php echo $this->element('paging_counter');?>
<div class="overflow-block">
<table class="list">
    <tr>
        <th><?php echo $this->Paginator->sort(__l('Date'),'created');?></th>
        <th><?php echo $this->Paginator->sort(__l('User'),'User.username');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Token'),'doexpresscheckout_token');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Ack'),'doexpresscheckout_ack');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Transaction ID'),'doexpresscheckout_transaction_id');?></th>
      <th ><?php echo $this->Paginator->sort(__l('Amount'),'doexpresscheckout_amt');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Fee Amout'),'doexpresscheckout_fee_amt');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Tax Amout'),'doexpresscheckout_tax_amt');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Curreny Code'),'doexpresscheckout_currency_code');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Payment Status'),'doexpresscheckout_payment_status');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Profile ID'),'docreaterecurringpaymentsprofile_profileid');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Profile Status'),'docreaterecurringpaymentsprofile_profilestatus');?></th>
        <th ><?php echo $this->Paginator->sort(__l('Profile Ack'),'docreaterecurringpaymentsprofile_ack');?></th>
         <th ><?php echo $this->Paginator->sort(__l('Profile Build'),'docreaterecurringpaymentsprofile_build');?></th>
	</tr>
<?php
if (!empty($paypalTransactionLogs)):

$i = 0;
foreach ($paypalTransactionLogs as $paypalTransactionLog):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>	<tr<?php echo $class;?>>

		<td><?php echo $this->Html->cDateTime($paypalTransactionLog['PaypalTransactionLog']['created']);?></td>
		<td><?php echo $this->Html->link($this->Html->cText($paypalTransactionLog['User']['username']), array('controller'=> 'users', 'action' => 'view', $paypalTransactionLog['User']['username'],'admin' => false), array('escape' => false));?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_token']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_ack']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_transaction_id']);?></td>
		<td><?php echo $this->Html->cFloat($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_amt']);?></td>
		<td><?php echo $this->Html->cFloat($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_fee_amt']);?></td>
		<td><?php echo $this->Html->cFloat($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_tax_amt']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_currency_code']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['doexpresscheckout_payment_status']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['docreaterecurringpaymentsprofile_profileid']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['docreaterecurringpaymentsprofile_profilestatus']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['docreaterecurringpaymentsprofile_ack']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['docreaterecurringpaymentsprofile_build']);?></td>
		</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="26" class="notice"><?php echo __l('No Paypal Transaction Logs available');?></td>
	</tr>
<?php
endif;
?>
</table>
</div>
<?php
if (!empty($paypalTransactionLogs)) {
    echo $this->element('paging_links');
}
?>
</div>
