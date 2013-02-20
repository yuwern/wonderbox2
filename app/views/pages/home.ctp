<script type="text/javascript">
$(function(){
	var month = <?php  echo Configure::read('header.month') - 1; ?>;
	var year = <?php  echo Configure::read('header.year'); ?>;
	var ts = (new Date(year, month, 15)).getTime();
	$('#countdown').countdown({
		timestamp : ts
	});
});
</script>
<!-- Brand Logo Sec  -->
          		<div class="brand_logo">
                  	  <h3><?php echo __l('Brands that we intend to bring to you in your next').' '.Configure::read('site.name'); ?></h3>
                      <ul>
						<li><?php echo $this->Html->image('b_logo1.jpg',array('width'=>'114','height'=>'49')); ?></li>
						<li><?php echo $this->Html->image('b_logo2.jpg',array('width'=>'114','height'=>'49')); ?></li>
						<li><?php echo $this->Html->image('b_logo3.jpg',array('width'=>'114','height'=>'49')); ?></li>
						<li><?php echo $this->Html->image('b_logo4.jpg',array('width'=>'114','height'=>'49')); ?></li>
						<li><?php echo $this->Html->image('b_logo5.jpg',array('width'=>'114','height'=>'49')); ?></li>
						<li><?php echo $this->Html->image('b_logo6.jpg',array('width'=>'114','height'=>'49')); ?></li>
						<li><?php echo $this->Html->image('b_logo7.jpg',array('width'=>'114','height'=>'49')); ?></li>
						<li><?php echo $this->Html->image('b_logo8.jpg',array('width'=>'114','height'=>'49')); ?></li>
				      </ul>
           		</div>
                <!-- ADD SEC -->
                <div class="ad_sec">
                	<div class="ad1"><?php echo $this->element('home-page-organizers-index'); ?></div>
                    <div class="ad2"><?php echo $this->Html->image('ad2.jpg',array('width'=>'209','height'=>'193')); ?></div>
                    <div class="ad3">
                    	<div class="sub_box">
                       	  <div class="s-box-left">
                           	<h2><strong><?php echo __l('NEXT SURPRISE'); ?></strong></h2>
                            <p><?php echo $this->Html->image('sub_img.jpg',array('width'=>'89','height'=>'85')); ?></p>
                           </div>
                            <div class="s-box-right">
                            	<div class="date-row">
									<div id="countdown"></div>
                                	<p><?php echo __l('DAYS'); ?></p>
                                    <p><?php echo __l('HOURS'); ?></p>
                                    <p><?php echo __l('MINUTES'); ?></p>
                                </div>
                              <div class="rate-row"> 
                                	<span class="c1"><?php echo __l('LIMITED UNITS'); ?> <br /><b><?php echo __l('DELIVERY TO YOUR DOORSTEP'); ?></b></span>
                                    <span class="c2"><?php echo  configure::read('site.currency'); ?></span>
					                 <span class="c3"> <?php $cost = explode('.',$package['Package']['cost']); echo  $cost[0]; ?></span>
                                    <span class="c4"> <?php echo  $cost[1]; ?></span>
                                <div class="clear"></div>
								  <?php if($this->Html->checkPackageAvialable() > 0): ?>
                                  <p><?php echo $this->Html->link(' ', array('controller' => 'packages', 'action' => 'subscribe', 'admin' => false), array('escape'=>false,'title' =>__l('Subscribe Now'),'class'=>'rate-subs-now')); ?></p>
								  <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
    