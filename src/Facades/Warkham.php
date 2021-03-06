<?php
namespace Warkham\Facades;

use Illuminate\Support\Facades\Facade;
use Warkham\WarkhamServiceProvider;

/**
 * Facade for Warkham
 */
class Warkham extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		// Build Container at runtime if necessary
		if (!static::$app) {
			static::make();
		}

		return 'warkham';
	}

	/**
	 * Create application container
	 *
	 * @return Illuminate\Container\Container
	 */
	public static function make()
	{
		static::$app = WarkhamServiceProvider::make();

		return static::$app;
	}
}
