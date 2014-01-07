<?php
namespace Warkham\Abstracts;

use Former\Traits\Field;

/**
 * An abstract field class for all fields to extend
 */
abstract class AbstractField extends Field
{
  /**
   * Properties to be injected as attributes
   *
   * @var array
   */
  protected $injectedProperties = array('type', 'name', 'value');

	/**
	 * Enable or disable a field
	 *
	 * @param boolean $enabled
	 *
	 * @return self
	 */
	public function enable($enabled)
	{
		return $this->setDataAttribute('disabled', !$enabled);
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

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