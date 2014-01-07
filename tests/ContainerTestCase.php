<?php
namespace Warkham;

use Illuminate\Container\Container;
use Mockery;
use PHPUnit_Framework_TestCase;

class ContainerTestCase extends PHPUnit_Framework_TestCase
{
	/**
	 * The current container
	 *
	 * @var Illuminate\Container\Container
	 */
	protected $app;

	/**
	 * Set up the mocked container
	 */
	public function setUp()
	{
		$this->app = new Container;

		// Bind mocked instances
		$this->app['url'] = $this->mockUrlGenerator();
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
	/////////////////////////// MOCKED INSTANCES ///////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Mock an UrlGenerator instance
	 *
	 * @return Mockery
	 */
	public function mockUrlGenerator()
	{
		return Mockery::mock('Illuminate\Routing\UrlGenerator', array(
			'route' => 'http://localhost/route',
		));
	}
}