<?php
namespace Warkham;

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

		return $app;
	}
}