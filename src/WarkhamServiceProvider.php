<?php
namespace Warkham;

use Former\FormerServiceProvider;
use Former\MethodDispatcher;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

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
		$app = $serviceProvider->bindCoreClasses($app);
		$app = $serviceProvider->bindWarkhamClasses($app);

		// Set framework
		$app['former']->framework('TwitterBootstrap3');

		return $app;
	}

	/**
	 * Bind core classes to the Container
	 *
	 * @param Container $app
	 *
	 * @return Container
	 */
	public function bindCoreClasses(Container $app)
	{
		$app->bindIf('events', function ($app) {
			return new Dispatcher($app);
		}, true);

		$app->bindIf('router', function ($app) {
			return new Router($app['events'], $app);
		}, true);

		$app->bind('url', function ($app) {
			return new UrlGenerator($app['router']->getRoutes(), $app['request']);
		});

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
			$methodDispatcher = array('Warkham\\Fields\\', Warkham::FIELDSPACE);
			$methodDispatcher = new MethodDispatcher($app, $methodDispatcher);

			return new Warkham($app, $methodDispatcher);
		});

		return $app;
	}
}
