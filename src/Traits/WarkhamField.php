<?php
namespace Warkham\Traits;

use Illuminate\Support\Str;

/**
 * A trait that adds Warkham-related methods to fields
 */
trait WarkhamField
{
	/**
	 * Enable or disable a field
	 *
	 * @param boolean $enabled
	 *
	 * @return self
	 */
	public function enable($enabled)
	{
		return $this->disabled($enabled ? 'false' : 'true');
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set a data-url attribute
	 *
	 * @param string $route
	 */
	protected function setRoute($route)
	{
		// Find route
		$route = Str::contains('@', $route) ? $this->app['url']->controller($route) : $this->app['url']->route($route);
		if ($route) {
			$this->setAttribute('data-url', $route);
		}

		return $this;
	}

	/**
	 * Set a data attribute on the field
	 *
	 * @param string $attribute
	 * @param mixed  $value
	 */
	protected function setDataAttribute($attribute, $value)
	{
		// Format boolean values
		if (is_bool($value)) {
			$value = $value ? 'true' : 'false';
		}

		$this->setAttribute('data-'.$attribute, $value);

		return $this;
	}
}
