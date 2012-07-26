<?php /* SVN: $Id: admin_index.ctp 59784 2011-07-11 05:09:38Z mohanraj_109at09 $ */ ?>
	<?php 
		if(!empty($this->request->params['isAjax'])):
			echo $this->element('flash_message');
		endif;
	?>
	<?php if(empty($this->request->params['isAjax']) && empty($this->request->params['named']['stat'])): ?>
	<div class="js-tabs">
        <ul class="clearfix">
            <li><?php echo $this->Html->link(__l('Users'), array('controller' => 'users', 'action' => 'index', 'main_filter_id' => ConstUserTypes::User),array('title' => __l('Users')));?></li>
			<?php if(Configure::read('facebook.is_enabled_facebook_connect')): ?>
                <li><?php echo $this->Html->link(__l('Facebook Users'), array('controller' => 'users', 'action' => 'index', 'main_filter_id' => ConstMoreAction::FaceBook),array('title' => __l('FaceBook Users')));?></li>
			<?php endif; ?>
              <li><?php echo $this->Html->link(__l('Admin'), array('controller' => 'users', 'action' => 'index', 'main_filter_id' => ConstUserTypes::Admin),array('title' => __l('Admin')));?></li>
            <li><?php echo $this->Html->link(__l('All'), array('controller' => 'users', 'action' => 'index', 'main_filter_id' => 'all'),array('title' => __l('All')));?></li>
       </ul>       
    </div>
<?php else: ?>
		<div class="js-response">
        <?php if(!empty($this->request->params['named']['main_filter_id']) && empty($this->request->params['named']['filter_id']) && empty($this->request->data)): ?>
           <div class="users index js-responses">
             <div class="js-tabs">      
                <ul class="clearfix">    
                    <li><?php echo $this->Html->link(sprintf(__l('Active Users(%s)'),$active), array('controller' => 'users', 'action' => 'index', 'filter_id' => ConstMoreAction::Active,'main_filter_id' => $this->request->params['named']['main_filter_id'],'stat' => (!empty($this->request->params['named']['stat']) ? $this->request->params['named']['stat'] : '')),array('title' => sprintf(__l('Active Users(%s)'),$active)));?></li>
                    <li><?php echo $this->Html->link(sprintf(__l('Inactive Users(%s)'),$inactive), array('controller' => 'users', 'action' => 'index', 'filter_id' => ConstMoreAction::Inactive, 'main_filter_id' => $this->request->params['named']['main_filter_id'],'stat' => (!empty($this->request->params['named']['stat']) ? $this->request->params['named']['stat'] : '')),array('title' => sprintf(__l('Inactive Users(%s)'),$inactive))); ?></li>
                    <li><?php echo $this->Html->link(sprintf(__l('All(%s)'),$active + $inactive),array('controller'=> 'users', 'action'=>'index', 'filter_id' => 'all','main_filter_id' => $this->request->params['named']['main_filter_id'],'stat' => (!empty($this->request->params['named']['stat']) ? $this->request->params['named']['stat'] : '')),array('title' => sprintf(__l('All(%s)'),$active + $inactive))); ?></li>
                </ul>
             </div>
        <?php else: ?>
         	<div class="js-search-responses">
            <h2><?php echo $pageTitle; ?></h2>
        	<?php if(empty($this->request->params['named']['from_more_actions'])): ?>
                <?php echo $this->Form->create('User', array('type' => 'post', 'class' => 'normal search-form clearfix js-ajax-form {"container" : "js-search-responses"}', 'action'=>'index')); ?>
               
                            <?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
                            <?php echo $this->Form->input('main_filter_id', array('type' => 'hidden', 'value' => !empty($this->request->params['named']['main_filter_id'])? $this->request->params['named']['main_filter_id']:'')); ?>
                            <?php echo $this->Form->input('filter_id', array('type' => 'hidden', 'value' => !empty($this->request->params['named']['filter_id'])?$this->request->params['named']['filter_id']:'')); ?>
                            <?php echo $this->Form->input('tab_check', array('type' => 'hidden', 'value' => '1')); ?>
                     
                            <?php echo $this->Form->submit(__l('Search'),array('name' => "data['User']['search']"));?>
                  
                <?php echo $this->Form->end(); ?>
                   <div class="clearfix add-block1">
	        	<?php if(empty($this->request->params['named']['from_more_actions'])): ?>
             
                    <?php echo $this->Html->link(__l('Add'), array('controller' => 'users', 'action' => 'add'), array('class' => 'add','title'=>__l('Add'))); ?>
               
              <?php endif; ?>
              	<?php if(empty($this->request->params['named']['from_more_actions'])): ?>
                
                    <?php
                        echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'users', 'action' => 'index','city' => $city_slug, 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export'));
                    ?>
                  
	            <?php endif; ?>
	              </div>
            <?php endif; ?>
                <?php echo $this->Form->create('User' , array('class' => 'normal js-ajax-form {"container" : "js-moreaction-responses"}','action' => 'update'));  ?>
                <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url."/"."from_more_actions:1")); ?>
	        	<?php if(empty($this->request->params['named']['from_more_actions'])): ?>
	                <?php echo $this->element('paging_counter'); ?>
	            <?php endif; ?>
                <div class="overflow-block">
             	<div class="js-moreaction-responses">
                <table class="list">
                    <tr>
                        <th><?php echo __l('Select'); ?></th>
                          <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Email'), 'User.email'); ?></div></th>
                        <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username'); ?></div></th>
                         <?php if($this->request->params['named']['filter_id'] == 'all') { ?>
                            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Active'), 'User.is_active'); ?></div></th>
                        <?php } ?>
                        <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Email confirmed'), 'User.is_email_confirmed'); ?></div></th>
                        <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Login Count'), 'User.user_login_count'); ?></div></th>
                        <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Signup IP'), 'User.signup_ip'); ?></div></th>
                        <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Created On'), 'User.created'); ?></div></th>
		                        <th class="dr"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Available Balance Amount'), 'User.available_balance_amount').' ('.Configure::read('site.currency').')'; ?></div></th>
                    </tr>
					          <?php
                if (!empty($users)):
                $i = 0;
                foreach ($users as $user):
                    $class = null;
                    if ($i++ % 2 == 0):
                        $class = ' class="altrow"';
                    endif;
                    if($user['User']['is_active']):
                        $status_class = 'js-checkbox-active';
                    else:
                        $status_class = 'js-checkbox-inactive';
                    endif;
                    $online_class = 'offline';
                    if (!empty($user['CkSession']['user_id'])) {
                        $online_class = 'online';
                    }
                ?>
                    <tr<?php echo $class;?>>
                        <td>
                            <div class="actions-block">
                                <div class="actions round-5-left cities-action-block">
                                <span><?php echo $this->Html->link(__l('Edit'), array('controller' => 'user_profiles', 'action'=>'edit', $user['User']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
                            <?php if($user['User']['user_type_id'] != ConstUserTypes::Admin){ ?>
                                <span><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $user['User']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
                            <?php } ?>
	                               <?php if(Configure::read('user.is_email_verification_for_register') and (!$user['User']['is_active'] or !$user['User']['is_email_confirmed'])):
                                  ?>
                                  <span>
                                  <?php      echo $this->Html->link(__l('Resend Activation'), array('controller' => 'users', 'action'=>'resend_activation', $user['User']['id'], 'admin' => false),array('title' => __l('Resend Activation'),'class' =>'recent-activation'));
                                    ?>
                                    </span>
                                    <?php
                                  endif;
                            ?>
                   
               </div>
                            </div>
                        <?php
                         if($user['User']['user_type_id'] != ConstUserTypes::Admin):
                          echo $this->Form->input('User.'.$user['User']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$user['User']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list'));
                         endif;
                         ?>
                        </td>
                        <td class="dl"><?php echo $this->Html->cText($user['User']['email']);?></td>
                        <td class="dl">
						<?php
						$chnage_user_info = $user['User'];
						$chnage_user_info['UserAvatar'] = $user['UserAvatar'];
						echo $this->Html->getUserAvatarLink($chnage_user_info, 'micro_thumb',false);
						?>
                            <?php

                                 echo $this->Html->getUserLink($user['User']);
                            ?>
                        </td>
               
                       
                        <?php if($this->request->params['named']['filter_id'] == 'all') { ?>
                            <td><?php echo ($user['User']['is_active']) ? __l('Active') : __l('Inactive'); ?></td>
                        <?php } ?>
                        <td><?php echo ($user['User']['is_email_confirmed']) ? __l('Yes') : __l('No'); ?></td>
                        <td><?php echo $this->Html->link($this->Html->cInt($user['User']['user_login_count'], false), array('controller' => 'user_logins', 'action' => 'index', 'username' => $user['User']['username']));?></td>
                        <td>
                        <?php if(!empty($user['User']['signup_ip'])): ?>							
                            <?php echo $this->Html->cText($user['User']['signup_ip']).' ['.$user['User']['dns'].'' ;?>
                        <?php else: ?>
							<?php echo __l('N/A'); ?>
						<?php endif; ?>    
                        </td>
                        <td><?php if($user['User']['created'] == '0000-00-00 00:00:00'){
                                echo '-';
                            }else{
                                echo $this->Html->cDateTimeHighlight($user['User']['created']);
                            }?></td>

                        <td class="dr"><?php echo $this->Html->cCurrency($user['User']['available_balance_amount']);?></td>
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
                </div>
                <?php
                if (!empty($users) && empty($this->request->params['named']['from_more_actions']) && $this->request->params['named']['main_filter_id'] != ConstUserTypes::Admin):
                ?>
                    <div class="admin-select-block">
                    <div>
                     
                     <?php  if(!($this->request->params['named']['filter_id'] == 2 && $this->request->params['named']['main_filter_id'] == 1)): ?>
                     <?php echo __l('Select:'); ?>
                     <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
                     <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None')));?> 
                        <?php endif;?>
                        <?php if($this->request->params['named']['filter_id'] == 'all') { ?>
                            <?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Inactive'))); ?>
                            <?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Active'))); ?>
                        <?php } ?>
                    </div>
                        <div class="admin-checkbox-button"> 
						<?php 
						    $moreActionTypes = $moreActions;
							if($this->request->params['named']['filter_id'] !='all'){
							    unset($moreActionTypes[$this->request->params['named']['filter_id']]);
							  }
							  if(!($this->request->params['named']['filter_id'] == 2 && $this->request->params['named']['main_filter_id'] == 1)):
					           	echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'), 'options' => $moreActionTypes));
                              endif;
                        ?></div>
                        </div>
                    <div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                    </div>
                
                    <div class="hide">
                        <?php echo $this->Form->submit('Submit'); ?>
                    </div>
                <?php
                endif;
                echo $this->Form->end();
                ?>
             </div>
	    <?php if(!empty($this->request->params['named']['main_filter_id']) && empty($this->request->params['named']['filter_id']) && empty($this->request->data)): ?>
            </div>
        <?php endif; ?>
        
    <?php endif; ?>
	 </div>
<?php endif; ?>