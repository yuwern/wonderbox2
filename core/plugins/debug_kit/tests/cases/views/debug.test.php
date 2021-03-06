<?php
/**
 * DebugView test Case
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org
 * @package       debug_kit
 * @subpackage    debug_kit.tests.views
 * @since         DebugKit 0.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 **/
App::import('Core', 'View');

if (!class_exists('DoppelGangerView')) {
	class DoppelGangerView extends View {}
}

App::import('View', 'DebugKit.Debug');
App::import('Vendor', 'DebugKit.DebugKitDebugger');
/**
 * Debug View Test Case
 *
 * @package       debug_kit.tests
 */
class DebugViewTestCase extends CakeTestCase {

	public static $paths = array();

/**
 * setup paths for the case.
 *
 * @return void
 */
	public static function setUpBeforeClass() {
		self::$paths = array(
			'plugins' => App::path('plugins'),
			'views' => App::path('views'),
			'vendors' => App::path('vendors'),
			'controllers' => App::path('controllers'),
		);

		App::build(array(
			'views' => array(
				TEST_CAKE_CORE_INCLUDE_PATH . 'tests' . DS . 'test_app' . DS . 'views'. DS,
				APP . 'plugins' . DS . 'debug_kit' . DS . 'views'. DS,
				ROOT . DS . LIBS . 'view' . DS
			)
		), true);
	}

/**
 * restore paths.
 *
 * @return void
 */
	public static function tearDownAfterClass() {
		App::build(array(
			'plugins' => self::$paths['plugins'],
			'views' => self::$paths['views'],
			'vendors' => self::$paths['vendors'],
			'controllers' => self::$paths['controllers'],
		));
	}

/**
 * set Up test case
 *
 * @return void
 **/
	public function setUp() {
		parent::setUp();

		Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
		Router::parse('/');
		$this->Controller = new Controller();
		$this->View = new DebugView($this->Controller, false);	
	}

/**
 * tear down function
 *
 * @return void
 **/
	public function tearDown() {
		unset($this->View, $this->Controller);
		DebugKitDebugger::clearTimers();
	}

/**
 * test that element timers are working
 *
 * @return void
 **/
	public function testElementTimers() {
		$result = $this->View->element('test_element');
		$expected = <<<TEXT
<!-- Starting to render - test_element -->
this is the test element
<!-- Finished - test_element -->

TEXT;
		$this->assertEqual($result, $expected);

		$result = DebugKitDebugger::getTimers();
		$this->assertTrue(isset($result['render_test_element.ctp']));
	}
/**
 * test rendering and ensure that timers are being set.
 *
 * @access public
 * @return void
 */
	public function testRenderTimers() {
		$request = new CakeRequest('/posts/index');
		$request->addParams(Router::parse($request->url));
		$request->addPaths(array(
			'webroot' => '/',
			'base' => '/',
			'here' => '/posts/index',
		));
		$this->Controller->setRequest($request);
		$this->Controller->viewPath = 'posts';
		$this->Controller->layout = 'default';
		$View = new DebugView($this->Controller, false);
		$View->render('index');

		$result = DebugKitDebugger::getTimers();
		$this->assertEqual(count($result), 4);
		$this->assertTrue(isset($result['viewRender']));
		$this->assertTrue(isset($result['render_default.ctp']));
		$this->assertTrue(isset($result['render_index.ctp']));
		
		$result = DebugKitDebugger::getMemoryPoints();
		$this->assertTrue(isset($result['View render complete']));
	}
/**
 * Test for correct loading of helpers into custom view
 *
 * @return void
 */
	public function testLoadHelpers() {
		$this->View->helpers = array('Html', 'Js', 'Number');
		$this->View->loadHelpers();
		$this->assertInstanceOf('HtmlHelper', $this->View->Html);
		$this->assertInstanceOf('JsHelper', $this->View->Js);
		$this->assertInstanceOf('NumberHelper', $this->View->Number);
	}
/**
 * test that $out is returned when a layout is rendered instead of the empty
 * $this->output.  As this causes issues with requestAction()
 *
 * @return void
 **/
	public function testProperReturnUnderRequestAction() {
		$testapp = App::pluginPath('DebugKit') . 'tests' . DS . 'test_app' . DS . 'views' . DS;
		App::build(array('views' => array($testapp)));

		$this->View->set('test', 'I have been rendered.');
		$this->View->action = 'request_action_render';
		$this->View->name = 'DebugKitTest';
		$this->View->viewPath = 'debug_kit_test';
		$this->View->layout = false;
		$result = $this->View->render('request_action_render');

		$this->assertEqual($result, 'I have been rendered.');
	}
}
