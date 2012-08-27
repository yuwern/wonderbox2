		<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
				<?php endif; ?> <div class="js-responses">
                	<h1><?php echo __l('Redemption'); ?></h1>
					<?php echo $this->Form->create('User', array('action' => 'redemption', 'class' => 'normal-form', 'enctype' => 'multipart/form-data'));?>
                        <ul class="w-point">
							<li>
	                           <p> You have <span class="f16"> <?php echo $this->Html->cText($this->Html->getWonderPointAvialable($this->Auth->user('id')));?></span> Wonder points</p>
	                         </li>
							<?php if(!empty($packages)):
								foreach($packages as $key=>$val){
									 $default_value = $key;							
								}
							?>
							 <li>
	                           	<strong><?php echo $this->Form->input('User.package_type_id',array('options'=>$packages,'default'=> $default_value,'type'=>'radio','label' =>false,'legand'=>false)); ?></strong>
	                         </li>
							 <li><div class="submit">	<?php echo $this->Form->submit(__l('Redeem'),array('class'=>'btn5'));?></div>
	                         </li>
							<?php endif; ?>
					   </ul>
                <?php
                	echo $this->Form->end();
                ?>
                </div>
		<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>