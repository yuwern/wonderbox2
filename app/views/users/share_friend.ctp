<script type="text/javascript" src="<?php echo  Router::url('/', true); ?>/js/libs/jquery.zclip.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    $('p#copy-description').zclip({
        path:'<?php echo  Router::url('/', true); ?>js/ZeroClipboard.swf',
        copy:$('#js-share-url-link').val(),
		afterCopy:function(){
			$('#js-share-url-link').select();
            $('p#copy-description').text('Copied');
        }
    });
});
	</script>
		<div class="refer_friend">
                	<div class="submis-left"><?php echo $this->Html->image('refer_img.jpg'); ?></div>
                    <div class="submis-right">
                    	<div class="head">
                        	<h1><?php echo __l('Refer a Friend, Earn WonderBox Points!'); ?></h1>
                            <p><?php echo __l('All the best things in life are meant to be shared. Tell all your friends about WonderBox that you can all disover beauty secrets together!'); ?></p>
                        </div>
                        <p class="refer-cont"><?php echo __l('Because members who share WonderBox are awesome, we will be rewarding you for every one of your friends who subscribes to WonderBox. You will be rewarded with 200 WonderPoints for every friend that subscribes to WonderBox'); ?></p>
                   	  <div class="contact-address">
						 	<?php
							$share_url = Router::url('/', true).'users/refer/r:'.$this->Auth->user('email');
							?>
                        	<h1  class="refer-head"><?php echo __l('Method 1'); ?> <span>- <?php echo __l('Invite Friends from Facebook'); ?></span></h1>
                            <p class="align-Center"><?php echo $this->Html->link($this->Html->image('invite_now.jpg',array('width'=>'221','height'=>'79')), 'http://www.facebook.com/share.php?u='.Router::url(array('controller' => 'users', 'action' => 'refer', 'r' =>$this->Auth->user('email')), true), array('class' => 'face','target' => 'blank','escape'=>false,'title'=>__l('Invite Now')));?></p>
                        	<h1  class="refer-head"><?php echo __l('Method 2'); ?> <span>- <?php echo __l('Share this link anywhere');?></span></h1>
                          	<p class="c-url" id="copy-description"><?php echo __l('(Copy referral URL)'); ?></p>
                            <div class="input required">
                                <input name="" type="text" class="w100" value="<?php echo $share_url; ?>" readonly="true" class="refer-url-code" id="js-share-url-link"/>
                            </div>
                            
                        </div>
                        <div class="contact-box">
                        	<h1  class="refer-head"><?php echo __l('Method 3'); ?> <span>- <?php echo __l('Invite by Email'); ?></span></h1>
							<?php	echo $this->Form->create('User', array('action' => 'share_friend', 'class' => 'refer-form')); ?>
							<?php echo $this->Form->input('friends_email',array('type' => 'textarea', 'label' => __l('Email Addresses:'), 'info' => __l('Seperate email addresses with a comma. example: wonderbox@gmail.com, wonderbox@hotmail.com'))); ?>
                        	<?php echo $this->Form->input('message',array('type' => 'textarea', 'label' => __l('Message:')));?>
                           <?php  echo $this->Form->submit(__l('Send'),array('class'=>'btn1')); ?>
						   <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>

