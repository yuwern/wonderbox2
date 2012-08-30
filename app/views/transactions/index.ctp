<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
	<?php endif; ?> 
<?php if(empty($this->request->params['isAjax']) ): ?>	 <h1><?php echo __l('My Transactions');?></h1>	<?php endif; ?> <div class="transactions index js-response js-responses">
    <?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
            <th class="left-cur"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Date'), 'created');?></div></th>
            <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Billing Cycle'),'Package.name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Subscription Type');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Billing Amount');?></div></th>
			 <th class="dl right-cur"><div class="js-pagination"><?php echo __l('Wonder Points');?></div></th>	
        </tr>
    <?php
		if (!empty($transactions)):
			$i = 0;
			$j = 1;
			foreach ($transactions as $transaction):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
	?>
        <tr<?php echo $class;?>>
            <td><?php echo $this->Html->cDateTime($transaction['Transaction']['created']);?></td>
            <td class="dl">
				<?php  
				 if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd ):
					echo $this->Html->cText($transaction['TransactionType']['name']);
				else:
				echo $this->Html->cText($transaction['Package']['name']);
				endif;
				?>
            </td>
            <td class="dl">
				<?php 
				 if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd ):
				echo ' -- ';
				else:
				echo $this->Html->cText($transaction['TransactionType']['name']);
				endif;
				?>
            </td>
			 <td class="dl">
				<?php if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd ):
					echo ' -- ';
				else:
					echo Configure::read('site.currency'). ' '. $this->Html->cFloat($transaction['Package']['cost']);
				endif;
				?>
            </td>
			 <td class="dl">
			   <?php if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd ):
				   echo $this->Html->cText($transaction['Transaction']['wonder_points']);
				else:
			      echo $this->Html->cText($transaction['Package']['no_of_wonderpoints']);
				endif;
				?>
            </td>
        </tr>
    <?php
        $j++;
        endforeach;
    ?>
    <?php
    else:
    ?>
        <tr>
            <td colspan="11" class="notice"><?php echo __l('No Transactions available');?></td>
        </tr>
    <?php
    endif;
    ?>
    </table>
    <?php
    if (!empty($transactions)) {
        ?>
            <div class="js-pagination">
                <?php echo $this->element('paging_links'); ?>
            </div>
        <?php
    }
    ?>
    </div>
<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>