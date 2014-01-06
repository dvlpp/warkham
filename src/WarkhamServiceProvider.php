<?php
namespace Warkham;

use Former\FormerServiceProvider;
use Former\MethodDispatcher;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

/**
 * Binds the Warkham classes to the container
 */
class WarkhamServiceProvider extends ServiceProvider
{
	/**
	 * Register the various Warkham classes
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app = static::make($this->app);
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////// CLASS BINDINGS ////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Static alias for binding classes to a given Container
	 *
	 * @param Container $app
	 *
	 * @return Container
	 */
	public static function make(Container $app = null)
	{
		// If no Container, create one
		if (!$app) {
			$app = new Container;
		}

		// Call the class binders
		$serviceProvider = new static($app);
		$app = FormerServiceProvider::make($app);
		$app = $serviceProvider->bindWarkhamClasses($app);

		return $app;
	}

	/**
	 * Bind the Warkham classes to the Container
	 *
	 * @param Container $app
	 *
	 * @return Container
	 */
	public function bindWarkhamClasses(Container $app)
	{
		$app->singleton('warkham', function ($app) {
			return new Warkham($app, new MethodDispatcher($app));
		});

		return $app;
	}
}