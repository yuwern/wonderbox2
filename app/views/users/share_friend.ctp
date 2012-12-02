<script type="text/javascript" src="<?php echo  Router::url('/', true); ?>/js/libs/jquery.zclip.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    $('a#copy-description').zclip({
        path:'<?php echo  Router::url('/', true); ?>js/ZeroClipboard.swf',
        copy:$('#js-share-url-link').val(),
		afterCopy:function(){
			$('#js-share-url-link').select();
            $('a#copy-description').text('Copied');
        }
    });
});
	</script>
	<div class="refer-sys">
				<div class="refer-sys-pad">
                    <h1><?php echo __l('Refer a Friend, Earn WonderBox Points!'); ?></h1>
                    <p><?php echo __l("All the best things in life are meant to be shared. Tell all your friends about WonderBox that you can all disover beauty secrets together!"); ?> </p>
                    <br></br>
                    <p><?php echo __l('Because members who share WonderBox are awesome, we will be rewarding you for every one of your friends who subscribes to WonderBox. You will be rewarded with 200 WonderPoints for every friend that subscribes to WonderBox'); ?> </p>
                    <div class="share-box">
                    	<div class="share-box-left">
                        	<h2><?php echo __l('Invite Friends from Facebook'); ?></h2>
                       		<?php
							$share_url = Router::url('/', true).'users/refer/r:'.$this->Auth->user('email');
							?>
							<?php echo $this->Html->link(__l('Share it on Facebook'), 'http://www.facebook.com/share.php?u='.Router::url(array('controller' => 'users', 'action' => 'refer', 'r' =>$this->Auth->user('email')), true), array('class' => 'face','target' => 'blank'));?>
                        </div>
                        <div class="share-box-right">
                        	<h2><?php echo __l('Share this link anywhere'); ?> <a id="copy-description">Copy your referral URL</a></h2>
							<input type='text' value='<?php echo $share_url; ?>' readonly="true" class="refer-url-code" id="js-share-url-link"/>
							
                        </div>
                    </div>
                    <h2><?php echo __l('Or Invite by Email'); ?></h2>
					<?php	echo $this->Form->create('User', array('action' => 'share_friend', 'class' => 'refer-form')); ?>
                     <ul>
              				<li>
                            	<?php echo $this->Form->input('friends_email',array('type' => 'textarea', 'label' => __l('Email Addresses:'), 'info' => __l('Seperate email addresses with a comma. example: wonderbox@gmail.com, wonderbox@hotmail.com'))); ?>
                             </li>
							 <li>
                            	<?php echo $this->Form->input('message',array('type' => 'textarea', 'label' => __l('Message:')));?>
                             </li>
                            	
                             <li>
                            	<span><label for="msg">&nbsp;</label></span>
                                <span><?php  echo $this->Form->submit(__l('Send'),array('class'=>'but6','div'=> false)); ?></span>
								
                            </li>
                     </ul>
					<?php echo $this->Form->end(); ?>
				</div>
		</div>	
