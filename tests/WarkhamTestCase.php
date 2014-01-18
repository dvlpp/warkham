<?php
namespace Warkham;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/ContainerTestCase.php';

use HtmlObject\Traits\Tag;
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
		$this->mockUrlGenerator();
	}

	/**
	 * Reset the currently registered Former labels
	 *
	 * @return void
	 */
	public function resetLabels()
	{
		$this->former->labels = array();
		$this->former->ids    = array();
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// DUMMIES ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get an instance of a dummy field
	 *
	 * @return DummyField
	 */
	protected function getDummyField($class = 'DummyField')
	{
		$class = 'Warkham\Dummies\\'.$class;

		return new $class($this->app, 'text', 'dummy', 'dummy', 'foobar', array());
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
		$tag      = array_pull($attributes, 'tag') ?: 'input';
		$children = array_pull($attributes, 'children');

		// Create attributes array
		$attributes = array_merge(array(
			'name' => 'dummy',
			'type' => 'text',
		), $attributes);

		// Remove type if not an input
		if ($tag !== 'input') {
			unset($attributes['type']);
		}

		return array(
			'tag'        => $tag,
			'id'         => $attributes['name'],
			'attributes' => $attributes,
			'children'   => $children,
		);
	}

	/**
	 * Matches and asserts a field
	 *
	 * @param Tag    $field
	 * @param array  $attributes
	 *
	 * @return void
	 */
	protected function assertField(Tag $field, $attributes = array())
	{
		$matcher = $this->matchField($attributes);

		return $this->assertHtml($matcher, $field);
	}

	/**
	 * Assert a Select field
	 *
	 * @param Tag    $field
	 * @param array  $attributes
	 *
	 * @return void
	 */
	protected function assertSelect(Tag $field, $attributes = array())
	{
		$matcher = $this->matchField(array_merge(array(
			'tag'      => 'select',
			'children' => array(
				'count' => 2,
				'only'  => array(
					'tag' => 'option',
				),
			),
		), $attributes));

		return $this->assertHtml($matcher, $field);
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
		// Convert objects to HTML
		if (method_exists($output, 'render')) {
			$output = $output->render();
		}

		return $this->assertTag(
			$expected,
			$output,
			"Failing to assert that ".PHP_EOL.$output.PHP_EOL."matches".PHP_EOL.json_encode($expected));
	}
}
