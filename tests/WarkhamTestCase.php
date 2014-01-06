<?php
namespace Warkham;

require __DIR__.'/../vendor/autoload.php';

use PHPUnit_Framework_TestCase;
use Warkham\Abstracts\AbstractField;
use Warkham\Dummies\DummyField;

/**
 * The abstract test case for all Warkham tests
 */
abstract class WarkhamTestCase extends PHPUnit_Framework_TestCase
{
	/**
	 * The current container
	 *
	 * @var Illuminate\Container\Container
	 */
	protected $app;

	/**
	 * Set up the tests
	 */
	public function setUp()
	{
		$this->app = WarkhamServiceProvider::make();
	}

	/**
	 * Fetch a class from the container
	 *
	 * @param string $key
	 *
	 * @return object
	 */
	public function __get($key)
	{
		return $this->app[$key];
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// DUMMIES ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get an instance of a dummy field
	 *
	 * @return DummyField
	 */
	protected function getDummyField()
	{
		return new DummyField($this->app, 'text', 'dummy', 'dummy', 'foobar', array());
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ASSERTIONS ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Return a matcher for a field
	 *
	 * @param array  $attributes
	 *
	 * @return array
	 */
	protected function matchField($attributes = array())
	{
		$attributes = array_merge(array(
			'name'  => 'dummy',
			'value' => 'foobar',
		), $attributes);

		return array(
			'tag'        => 'input',
			'id'         => 'dummy',
			'attributes' => $attributes,
		);
	}

	/**
	 * Matches and asserts a field
	 *
	 * @param AbstractField $field
	 * @param array         $attributes
	 *
	 * @return void
	 */
	protected function assertField(AbstractField $field, $attributes = array())
	{
		$matcher = $this->matchField($attributes);

		return $this->assertTag($matcher, $field->render());
	}
}