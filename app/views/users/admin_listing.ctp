<div class="js-response">
            <?php echo $this->element('paging_counter'); ?>
                <div class="overflow-block">
                <table class="list">
                    <tr>
                        <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Username'), 'User.username'); ?></div></th>
                        <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Email'), 'User.email'); ?></div></th>
                        <th class="dl"><div class="js-pagination"><?php echo __l('Address'); ?></div></th>
                        <th class="dl"><div class="js-pagination"><?php echo __l('Account Created Date'); ?></div></th>
                      </tr>
					          <?php
                if (!empty($users)):
                $i = 0;
                foreach ($users as $user):
		     ?>
                    <tr>
                        <td class="dl"><?php echo $this->Html->cText($user['User']['username']);?></td>
                        <td class="dl"><?php echo $this->Html->cText($user['User']['email']);?></td>
                        <td class="dl"><?php echo $this->Html->getShippingAddress($user['User']['id']);?></td>
                        <td class="dl"><?php echo $this->Html->cDate($user['User']['created']);?></td>
                    </tr>
                <?php
                    endforeach;
					
                else:
                ?>
                    <tr>
                        <td colspan="17" class="notice"><?php echo __l('No users available');?></td>
                    </tr>
                <?php
                endif;
                ?>
                </table>
                </div>
			        <div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                  </div>
            
                </div>        