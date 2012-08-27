		<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
				<?php endif; ?> <div class="js-responses">
                	<h1><?php echo __l('Redemption'); ?></h1>
					<?php echo $this->Form->create('User', array('action' => 'redemption', 'class' => 'normal-form', 'enctype' => 'multipart/form-data'));?>
                        
					   <div  class="subs-box2 w-point">
					    <h3> You have <span class="f16"> <?php echo $this->Html->cText($this->Html->getWonderPointAvialable($this->Auth->user('id')));?></span> Wonder points</h3>
						<?php if(!empty($packages)): ?>
					   	<ul>
								
							<?php  $count =1 ;	foreach($packages as $package): 
						?>    	<li>
					
								<?php 	if($count == 1){
								$default_value = $package['Package']['id'];
								$count++;
							} echo $this->Form->input('User.package_type_id',array('options'=>array($package['Package']['id']=>'<strong>'.$package['PackageType']['name'].'</strong>'),'type'=>'radio','default'=>!empty($default_value)?$default_value:'','legend' => false)); ?>
						<?php endforeach; 	?>
							 
						</ul>
						<div class="submit">	<?php echo $this->Form->submit(__l('Redeem'),array('class'=>'btn5'));?></div>
							 <?php endif; ?>
						</div>
                <?php
                	echo $this->Form->end();
                ?>
                </div>
		<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>