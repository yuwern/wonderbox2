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
class FeaturedFixture extends CakeTestFixture {

/**
 * name property
 *
 * @var string 'Featured'
 * @access public
 */
	public $name = 'Featured';

/**
 * fields property
 *
 * @var array
 * @access public
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'article_featured_id' => array('type' => 'integer', 'null' => false),
		'category_id' => array('type' => 'integer', 'null' => false),
		'published_date' => 'datetime',
		'end_date' => 'datetime',
		'created' => 'datetime',
		'updated' => 'datetime'
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	public $records = array(
		array('article_featured_id' => 1, 'category_id' => 1, 'published_date' => '2007-03-31 10:39:23', 'end_date' => '2007-05-15 10:39:23', 'created' => '2007-03-18 10:39:23', 'updated' => '2007-03-18 10:41:31'),
		array('article_featured_id' => 2, 'category_id' => 1, 'published_date' => '2007-03-31 10:39:23', 'end_date' => '2007-05-15 10:39:23', 'created' => '2007-03-18 10:39:23', 'updated' => '2007-03-18 10:41:31'),
	);
}
