<?php
namespace Warkham;

require __DIR__.'/../vendor/autoload.php';

use HtmlObject\Element;
use PHPUnit_Framework_TestCase;
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
	 * @param Element $field
	 * @param array   $attributes
	 *
	 * @return void
	 */
	protected function assertField(Element $field, $attributes = array())
	{
		$matcher = $this->matchField($attributes);
		$render  = $field->render();

		return $this->assertTag(
			$matcher,
			$render,
			"Failing to assert that ".PHP_EOL.$render.PHP_EOL."matches".PHP_EOL.json_encode($matcher));
	}
}