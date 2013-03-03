	<div class="contact">
                	<div class="contact-left"><?php echo $this->Html->image('contact_img.jpg'); ?></div>
                    <div class="contact-right">
                    	<div class="head">
                        	<h1><?php echo __l('Need help?'); ?> </h1>
                            <p><?php echo __l('For answers to commonly asked questions including shipping, subscriptions, and orders, please read our FAQ!'); ?></p> <br>
                            <?php echo __l('Still need help? Send us a message, and we'll respond as soon as possible.'); ?></p>
                        </div>
                       	<div class="contact-address">
                        	<div class="address-box">
                            	<ul>
                                	<li>
                                    	<label><?php echo __l('MAILING ADDRESS'); ?></label>
                                    	<span><?php echo Configure::read('site.address'); ?></span>
                                    </li>
                                    <li>
                                    	<label><?php echo __l('EMAIL / PHONE'); ?></label>
                                    	<span><a href="mailto: info@wonderbox.com.my" title="info@wonderbox.com.my">info@wonderbox.com.my</a> </span>
                                    </li>
                                    <li>
                                    	<label><?php echo __l('OPERATING HOURS'); ?></label>
                                    	<span>24 hours (Online purchase) <br />8am - 6pm (Customer service)</span>
                                    </li>
                                </ul>
                            </div>
                        	<div class="shipp-box font-tahoma">
                            	<strong><?php echo __l('HAVE A QUESTION?'); ?></strong><br />
                                <?php echo __l('Contact our friendly customer service staff or visit our'); ?> <?php echo $this->Html->link(__l('FAQ section'), array('controller' => 'pages', 'action' => 'view', 'help_faq', 'admin' => false), array('title' => __l('FAQ section'),'class'=>'font-tahoma'));?> <?php echo __l('to learn more.'); ?> 
                            </div>
                            
                        </div>
                        <div class="contact-box">
							<?php echo $this->Form->create('Contact', array('class' => 'normal js-contact-form'));
								  echo $this->Form->input('first_name', array('label' => __l('Name')));	
								  echo $this->Form->input('email',array('label' => __l('Email')));
								  echo $this->Form->input('telephone',array('label' => __l('HANDPHONE')));	
								  echo $this->Form->input('message', array('label' => __l('Message'),'type' => 'textarea'));
								  echo $this->Form->submit(__l('Send'),array('class'=>'btn1'));
								  echo $this->Form->end();
							
							?>
                           </div>
                    </div>
                </div>