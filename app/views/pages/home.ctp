<?php echo $this->element('home-page-banners-index',array('cache' => array('config' => 'site_element_cache', 'key' => 'banner-slider')));?>

				<div class="banner_text">
					<h1>Discover Beauty Secrets At Your Doorstep</h1>
					<h3>	<ul>
					<li>Try out new products every month
					<li>Let our experts guide and inspire you
					<li>Learn and explore with your WonderBox community
					<li>Share your discoveries with all your friends and get rewarded
                                        </ul></h3>
					 <?php if (!$this->Auth->sessionValid()): ?>
					<span class="f-right"><?php echo $this->Html->link(sprintf(__l('Join Now')), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('class'=>'but3','title' => sprintf(__l('Join Now'))));?></span>
					<?php endif; ?>
				</div>
			</div>
			<h2>Brands that we intend to bring to you in your next WonderBox:</h2>
			<div class="brand">
				<ul>
					<li><?php echo $this->Html->image('brand1.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand2.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand3.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand4.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand5.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand6.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand7.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand8.jpg'); ?></li>
					<li><?php echo $this->Html->image('brand9.jpg'); ?></li>
				</ul>
			</div> 
