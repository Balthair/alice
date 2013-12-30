<?php
App::uses('Photographer', 'Model');

/**
 * Photographer Test Case
 *
 */
class PhotographerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.photographer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Photographer = ClassRegistry::init('Photographer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Photographer);

		parent::tearDown();
	}

}
