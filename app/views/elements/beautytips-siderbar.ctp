		<h4><?php echo __l('SEARCH'); ?></h4>
						<?php echo $this->Form->create('BeautyTip', array('controller'=>'beauty_tips','action'=>'index','type'=>'GET','enctype' => 'multipart/form-data','class' => 'normal'));
							  echo $this->Form->input('q',array('type'=>'text','label'=>'','value'=>'Enter keywords')); 
							  echo $this->Form->end();	
						?>
						<div class="topic">
							<h4><?php echo __l('WHAT\'S YOUR FAVOURITE TOPICS'); ?></h4>
							<?php  $categories = $this->Html->getCategoriesLists();
							  ?>
							<div class="links">
								<ul>
								<?php 
								if(!empty($categories)):
								$i = 0;
								$count = count($categories);
								$break = ceil($count /2 );
								foreach($categories as $category):
									echo '<li>'. $this->Html->link($category['Category']['name'],array('controller'=>'beauty_tips','action'=>'index','slug'=> $category['Category']['slug']),array('title'=>$category['Category']['name'])).'</li>';
									 if (($i + 1) % $break == 0 && ($i + 1) != $count) {?>
										</ul>
										</div>
										<div class="links">
										<ul>
									<?php }
									$i++;
								endforeach;
								else:?>
								<ul>
									<li> <?php echo __l('No Favourite topics avialable'); ?></li>
								</ul>
								<?php endif; ?>
						</div>						
                    </div>
		          