<?php
namespace Warkham;

use Closure;
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
		$this->mockUrlGenerator();
	}

	/**
	 * Destroy mocked instances after each test
	 *
	 * @return void
	 */
	public function tearDown()
	{
		Mockery::close();
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
	 * Bind a mocked instance into the Container
	 *
	 * @param string        $binding
	 * @param string        $class
	 * @param array|Closure $expectations
	 *
	 * @return Mockery
	 */
	protected function mock($binding, $class, $expectations)
	{
		// Create mocked instance
		if ($expectations instanceof Closure) {
			$mocked = Mockery::mock($class);
			$mocked = $expectations($mocked)->mock();
		} else {
			$mocked = Mockery::mock($class, $expectations);
		}

		// Bind into container
		$this->app[$binding] = $mocked;

		return $mocked;
	}

	/**
	 * Mock the Filesystem
	 *
	 * @return Mockery
	 */
	protected function mockFiles(array $expectations = array())
	{
		$this->mock('files', 'Illuminate\Filesystem\Filesystem', array_merge(array(
			'exists'     => true,
			'getRequire' => true,
		), $expectations));
	}

	/**
	 * Mock an UrlGenerator instance
	 *
	 * @return Mockery
	 */
	protected function mockUrlGenerator()
	{
		$this->mock('url', 'UrlGenerator', array(
			'route' => 'http://localhost/route',
		));
	}
}
