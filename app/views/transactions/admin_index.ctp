<?php /* SVN: $Id: admin_index.ctp 54285 2011-05-23 10:16:38Z aravindan_111act10 $ */ ?>
	<?php 
		if(!empty($this->request->params['isAjax'])):
			echo $this->element('flash_message');
		endif;
	?>
<div class="transactions index js-responses">
<?php if(empty($this->request->params['isAjax'])): ?>
		<h2><?php echo $this->pageTitle ; ?></h2>
<?php endif; ?>
	<div class="js-response">
	<?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Date'), 'Transaction.created');?></div></th>
            <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
			<th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Billing Cycle'),'Package.name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Subscription Type');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Billing Amount');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Wonder Points');?></div></th>	
            </tr>
    <?php
    if (!empty($transactions)):
    $i = 0;
    foreach ($transactions as $transaction):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
        <tr<?php echo $class;?>>
                <td><?php echo $this->Html->cDateTime($transaction['Transaction']['created']);?></td>
				<?php if(empty($this->request->params['named']['user_id'])):	?>
                    <td class="dl">
						<?php echo $this->Html->getUserAvatarLink($transaction['User'], 'micro_thumb', false); ?>
						<?php echo $this->Html->getUserLink($transaction['User']); ?>
					</td>
	            <?php endif; ?>
				<td class="dl">
				<?php   if ($transaction['Transaction']['class'] == 'ProductSurvey'): 
						echo $this->Html->cText('WonderPoints redemption');
						endif;
						if ($transaction['Transaction']['class'] == 'GiftUser'): 
						echo $this->Html->cText('GiftUser Package');
						endif;
						if ($transaction['Transaction']['class'] == 'Package'): 
						echo $this->Html->cText('Subscribe Package');
						endif;
						if ($transaction['Transaction']['class'] == 'ProductRedemption'): 
						echo $this->Html->cText('Product Redemption Package');
						endif;
						if ($transaction['Transaction']['class'] == 'BeautyTip'): 
						echo $this->Html->cText('Beauty Tip Package');
						endif;
				?>
            </td>
			   <td class="dl">
				<?php 	 if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductSurveryWonderPoint || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ShareExperience || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductDamage   || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::Refund      || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperiencePhoto || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperienceBlog || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ExperienceVideo  || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::BeautyTipAmountPaid   || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ProductRedemptionAmountPaid   ):
					echo $this->Html->cText($transaction['TransactionType']['name']);
				else:
				echo $this->Html->cText($transaction['Package']['name']);
				endif; 
				?>
            </td>
			 <td class="dl">
				<?php if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductSurveryWonderPoint|| $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ShareExperience || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductDamage   || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::Refund    || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperiencePhoto || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperienceBlog || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ExperienceVideo      ):
					echo ' -- ';
				else:
					if($transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::BeautyTipAmountPaid || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ProductRedemptionAmountPaid ):
					echo Configure::read('site.currency'). ' '. $this->Html->cInt($transaction['Transaction']['amount']);
					else:
					echo Configure::read('site.currency'). ' '. $this->Html->cInt($transaction['Package']['cost']);
					endif;
				endif;?>
            </td>
			 <td class="dl">
			<?php if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductSurveryWonderPoint || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ShareExperience || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductDamage   || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::Refund       || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperiencePhoto || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperienceBlog || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ExperienceVideo  || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::BeautyTipAmountPaid  || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ProductRedemptionAmountPaid   ):
				   echo $this->Html->cText($transaction['Transaction']['wonder_points']);
				else:
			      echo $this->Html->cText($transaction['Package']['no_of_wonderpoints']);
				endif;
				?>
            </td>
               </tr>
    <?php
        endforeach; ?>
   <?php else:
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
</div>
