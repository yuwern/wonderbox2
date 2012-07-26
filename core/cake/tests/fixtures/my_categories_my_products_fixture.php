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
class MyCategoriesMyProductsFixture extends CakeTestFixture {

/**
 * name property
 *
 * @var string 'MyCategoriesMyProducts'
 * @access public
 */
	public $name = 'MyCategoriesMyProducts';

/**
 * fields property
 *
 * @var array
 * @access public
 */
	public $fields = array(
		'my_category_id' => array('type' => 'integer'),
		'my_product_id' => array('type' => 'integer'),
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	public $records = array(
		array('my_category_id' => 1, 'my_product_id' => 1),
		array('my_category_id' => 2, 'my_product_id' => 1),
		array('my_category_id' => 2, 'my_product_id' => 2),
		array('my_category_id' => 3, 'my_product_id' => 2),
	);
}
