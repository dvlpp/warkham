<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class OracleTest extends WarkhamTestCase
{
	/**
	 * Dummy data for the endpoint
	 *
	 * @var array
	 */
	protected $endpoint = [1 => 'foo', 2 => 'bar'];

	public function testCanCreateOracle()
	{
		$field = $this->warkham->oracle('dummy')->options(['foo', 'bar']);

		$this->assertSelect($field, array(
			'class' => 'wkm-oracle',
		));
	}

	public function testCanFetchDataFromRouteIfNecessary()
	{
		$this->mockFiles(array(
			'getRemote' => json_encode($this->endpoint),
		));

		$field = $this->warkham->oracle('dummy')->setAvailableValuesRoute('route')->remote(false);
		$this->assertSelect($field, array(
			'class'       => 'wkm-oracle',
			'data-url'    => 'http://localhost/route',
			'data-remote' => 'false',
		));
		$this->assertContains('<option value="1">foo</option><option value="2">bar</option>', $field->render());
	}

	public function testCanLetJavascriptFetchTheValues()
	{
		$this->mockFiles(array(
			'getRemote' => json_encode($this->endpoint),
		));

		$field = $this->warkham->oracle('dummy')->setAvailableValuesRoute('route')->remote(true);
		$this->assertSelect($field, array(
			'class'       => 'wkm-oracle',
			'data-url'    => 'http://localhost/route',
			'data-remote' => 'true',
			'children'    => array(),
		));
		$this->assertNotContains('<option value="1">foo</option><option value="2">bar</option>', $field->render());
	}
}
