<?php
/**
 * Short description for file.
 *
 * PHP 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/view/1196/Testing>
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/view/1196/Testing CakePHP(tm) Tests
 * @package       cake.tests.fixtures
 * @since         CakePHP(tm) v 1.2.0.4667
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Short description for class.
 *
 * @package       cake.tests.fixtures
 */
class SampleFixture extends CakeTestFixture {

/**
 * name property
 *
 * @var string 'Sample'
 * @access public
 */
	public $name = 'Sample';

/**
 * fields property
 *
 * @var array
 * @access public
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'apple_id' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'length' => 40, 'null' => false)
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	public $records = array(
		array('apple_id' => 3, 'name' => 'sample1'),
		array('apple_id' => 2, 'name' => 'sample2'),
		array('apple_id' => 4, 'name' => 'sample3'),
		array('apple_id' => 5, 'name' => 'sample4')
	);
}
