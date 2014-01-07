<?php
namespace Warkham;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/ContainerTestCase.php';

use HtmlObject\Element;
use Warkham\Dummies\DummyField;

/**
 * The abstract test case for all Warkham tests
 */
abstract class WarkhamTestCase extends ContainerTestCase
{
	/**
	 * Set up the tests
	 */
	public function setUp()
	{
		parent::setUp();

		$this->app = WarkhamServiceProvider::make($this->app);
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
			'name' => 'dummy',
			'type' => 'text',
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

		return $this->assertHtml($matcher, $render);
	}

	/**
	 * Asserts a piece of HTML matches an array
	 *
	 * @param array  $expected
	 * @param string $output
	 *
	 * @return vodi
	 */
	protected function assertHtml($expected, $output)
	{
		return $this->assertTag(
			$expected,
			$output,
			"Failing to assert that ".PHP_EOL.$output.PHP_EOL."matches".PHP_EOL.json_encode($expected));
	}
}