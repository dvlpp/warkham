<?php
namespace Warkham;

use DOMDocument;
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

		// Open a form
		$this->app['warkham']->open();
		$this->app['warkham']->framework('Nude');
	}

	public function tearDown()
	{
		parent::tearDown();

		$this->app['warkham']->close();
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

		return $this->assertHtmlStructure($matcher, $field);
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

		return $this->assertHtmlStructure($matcher, $field);
	}

	/**
	 * Assert a piece of HTML matches another
	 *
	 * @param string $expected
	 * @param string $output
	 *
	 * @return string
	 */
	protected function assertHtml($expected, $output)
	{
		$expected = $this->createDomFromString($expected);
		$output   = $this->createDomFromString($output);

		$this->assertEquals($expected, $output);
	}

	/**
	 * Asserts a piece of HTML matches an array
	 *
	 * @param array  $expected
	 * @param string $output
	 *
	 * @return vodi
	 */
	protected function assertHtmlStructure($expected, $output)
	{
		// Convert objects to HTML
		if (method_exists($output, 'render')) {
			$output = $output->render();
		}

		return $this->assertTag(
			$expected,
			$output,
			"Failing to assert that ".PHP_EOL.$this->formatHtml($output).PHP_EOL."matches".PHP_EOL.json_encode($expected));
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////////// DEBUG /////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Debug a field's HTML
	 *
	 * @param object $field
	 *
	 * @return string
	 */
	protected function debug($field)
	{
		print $this->formatHtml($field->render());
		exit;
	}

	/**
	 * Create a DOM object from a string
	 *
	 * @param string $html
	 *
	 * @return DOMDocument
	 */
	protected function createDomFromString($html)
	{
		libxml_use_internal_errors(true);

		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadHTML($html);

		return $dom;
	}

	/**
	 * Format a piece of HTML
	 *
	 * @param string $html
	 *
	 * @return string
	 */
	protected function formatHtml($html)
	{
		$dom = $this->createDomFromString($html);

		// Remove extra nodes from output
		$output = $dom->saveHTML();
		$output = preg_replace('/<(\/|!)?(DOCTYPE.+|html|body)>/', '', $output);
		$output = trim($output);

		return $output;
	}
}
