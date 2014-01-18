<?php
namespace Warkham\Traits;

use Illuminate\Support\Str;
use ReflectionClass;

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

	/**
	 * Swap out the current values
	 *
	 * @param array $values
	 *
	 * @return self
	 */
	public function setAvailableValues($values)
	{
		$this->values = $values;

		switch ($this->interface) {
			case 'radio':
				return $this->radios($values);

			case 'checklist':
				return $this->checkboxes($values);

			case 'list':
				return $this->options($values);

			default:
				return $this->setValue($values);
		}
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Mutate the field to another field
	 *
	 * @param string $field
	 *
	 * @return Field
	 */
	protected function mutateTo($field)
	{
		// Go around PHP's reserved list
		if ($field === 'Choice\\List') {
			$field = 'Choice\\Select';
		}

		// Get field type
		$type = class_basename(strtolower($field));
		$type = array_get(array(
			'checklist' => 'checkbox',
			'list'      => 'select',
		), $type, $type);

		// Create new instance
		$field = new ReflectionClass('Warkham\Fields\\'.ucfirst($field));
		$field = $field->newInstanceArgs(array(
			$this->app,
			$type,
			$this->name,
			$this->label,
			array(),
			null,
			array()
		));

		// Pass values and attributes (except class)
		$attributes = array_except($this->attributes, 'class');
		$field->setAttributes($attributes);
		$field->setAvailableValues($this->values);

		// Add Framework classes
		$this->currentFramework()->getFieldClasses($field, []);

		return $field;
	}

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

		// Format arrays
		elseif (is_array($value)) {
			$value = json_encode($value);
		}

		$this->setAttribute('data-'.$attribute, $value);

		return $this;
	}
}
