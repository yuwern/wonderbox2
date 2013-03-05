<?php /* SVN: $Id: admin_edit.ctp 56835 2011-06-14 13:42:32Z arovindhan_144at11 $ */ ?>
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<?php
    if(!empty($page)):
        ?>
        <div class="js-tabs">
        <ul>
            <li><span><?php echo $this->Html->link(__l('Preview'), '#preview'); ?></span></li>
            <li><span><?php echo $this->Html->link(__l('Change'), '#add'); ?></span></li>
        </ul>
        <div id="preview">
            <div class="page">
                <h2><?php echo $page['Page']['title']; ?></h2>
                <div class="entry">
                   <?php echo $page['Page']['content']; ?>
                </div>
            </div>
        </div>
        <?php
    endif;
?>
<div id="add">
    <h2><?php echo __l('Edit Page'); ?></h2>
    <div class="pages form">      
        <fieldset>
            <?php
				echo $this->Form->create('Page', array('class' => 'normal', 'enctype' => 'multipart/form-data'));
                echo $this->Form->input('id');
                echo $this->Form->input('title', array('between' => '', 'label' => __l('Page title')));
                echo $this->Form->input('content', array('type' => 'textarea', 'class' => 'js-editor', 'label' =>__l('Body'), 'info' => __l('Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##, ##SITE_CONTACT_PHONE##, ##SITE_CONTACT_EMAIL##')));                
                echo $this->Form->input('slug',array('label' => __l('Slug'),'info' => __l('If you change value of this field then don\'t forget to update links created for this page. It should be page/value of this field.')));
                echo $this->Form->input('beauty_tips',array('label' => __l('Checked this to list in Beauty tips')));
				?>
                <div class="submit-block clearfix">
                <?php echo $this->Form->submit(__l('Update'), array('name' => 'data[Page][Update]')); ?>
                    <div class = "cancel-block">
                        <?php  echo  $this->Html->link(__l('Cancel'), array('controller' => 'pages', 'action' => 'index'), array('title' => 'Cancel'));?>
                     </div>
               </div>
            	<?php echo $this->Form->end(); ?>
        </fieldset>
    </div>
</div>
<?php
    if(!empty($page)):
    ?>
    </div> <!-- js-tabs end !>
    <?php
endif;
?>
