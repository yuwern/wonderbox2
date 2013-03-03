			<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Subscription Redemption'); ?></h1>
                            <p> <?php echo __l('Account copywriting text, temporary text, layout format, copywriting text, temporary text, layout format.'); ?></p>
                        </div>
                       	<div class="acc-fm-box">
                        	<h3><?php echo __l('Redemption'); ?> </h3>
                        	<?php echo $this->Form->create('User', array('action' => 'redemption', 'class' => 'normal-form', 'enctype' => 'multipart/form-data'));?>
                           <div  class="subs-box2 w-point">
					    <p> You have <span class="f16"> <?php echo $this->Html->cText($this->Html->getWonderPointAvialable($this->Auth->user('id')));?></span> Wonder points</p>
						<?php if(!empty($packages)):
							$count =1 ;	foreach($packages as $package): 
							if($count == 1){
								$default_value = $package['Package']['id'];
								$count++;
							} 
							$wonder_points = Configure::read('wonderpoint.no_of_wonderpoints') * $package['PackageType']['no_of_months'];
							echo $this->Form->input('User.package_type_id',array('options'=>array($package['Package']['id']=>'<strong>'.$package['PackageType']['name'].' - '. $wonder_points.'</strong>'),'type'=>'radio','default'=>!empty($default_value)?$default_value:'','legend' => false)); ?>
						<?php endforeach; 	?>
						<?php echo $this->Form->submit(__l('Redeem'),array('class'=>'btn1','div'=>'input'));?>
						 <?php endif; ?>
						</div>
						<?php
						echo $this->Form->end();
						?>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>