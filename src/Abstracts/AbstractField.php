<?php
namespace Warkham\Abstracts;

use Former\Traits\Field;

/**
 * An abstract field class for all fields to extend
 */
abstract class AbstractField extends Field
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
		$enabled = !$enabled ? 'true' : 'false';
		$this->dataDisabled($enabled);

		return $this;
	}
}