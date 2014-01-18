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
		$field = $this->warkham->oracle('dummy');

		$this->assertField($field, array(
			'class' => 'wkm-oracle',
		));
	}

	public function testCanLetJavascriptFetchTheValues()
	{
		$field = $this->warkham->oracle('dummy')->setRemoteRoute('route')->setQueryMinLength(3);
		$this->assertField($field, array(
			'class'    => 'form-control wkm-oracle',
			'data-url' => 'http://localhost/route',
			'data-queryminlength' => 3,
		));
	}
}
