<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake.libs.view.templates.errors
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<h2><?php echo __('Missing Behavior Class'); ?></h2>
<p class="error">
	<strong><?php echo __('Error'); ?>: </strong>
	<?php echo __('The behavior class <em>%s</em> can not be found or does not exist.', $class); ?>
</p>
<p  class="error">
	<strong><?php echo __('Error'); ?>: </strong>
	<?php echo __('Create the class below in file: %s', APP_DIR . DS . 'models' . DS . 'behaviors' . DS . $file); ?>
</p>
<pre>
&lt;?php
class <?php echo $class;?> extends ModelBehavior {

}
?&gt;
</pre>
<p class="notice">
	<strong><?php echo __('Notice'); ?>: </strong>
	<?php echo __('If you want to customize this error message, create %s', APP_DIR . DS . 'views' . DS . 'errors' . DS . 'missing_behavior_class.ctp'); ?>
</p>

<?php echo $this->element('exception_stack_trace'); ?>
