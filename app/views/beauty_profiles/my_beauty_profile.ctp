		<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right ">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Beauty Account'); ?></h1>
                            <p> <?php echo __l('Account copywriting text, temporary text, layout format, copywriting text, temporary text, layout format.'); ?></p>
                        </div>
                       	<div class="acc-banner">
                        	<h3> <?php echo __l('My Beauty Profile'); ?></h3>
							<?php echo $this->element('../beauty_profiles/quiz',array('mybeautyprofile'=>1)); ?>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>