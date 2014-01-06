<?php
namespace Warkham;

require __DIR__.'/../vendor/autoload.php';

use PHPUnit_Framework_TestCase;

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
}