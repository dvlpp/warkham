<?php
namespace Warkham\Traits;

/**
 * Methods shared between implementations
 * of the Choice field
 */
trait Choice
{
	/**
	 * Change the current UI to something else
	 *
	 * @param string $choice
	 *
	 * @return AbstractField
	 */
	public function ui($choice)
	{
		if (!in_array($choice, ['radio', 'checklist', 'list'])) {
			return $this;
		}

		return $this->mutateTo('Choice\\'.ucfirst($choice));
	}

	/**
	 * Set the field as multiple
	 *
	 * @param boolean $multiple
	 *
	 * @return self
	 */
	public function multiple($multiple)
	{
		if ($this->interface === 'list') {
			parent::multiple(true);

			return $this->setDataAttribute('multiple', $multiple);
		}

		return $this;
	}

	/**
	 * Set the maximum number of values
	 *
	 * @param integer $max
	 */
	public function setMaxSelectionSize($max)
	{
		if ($this->interface === 'list' and $this->attributes['multiple']) {
			return $this->setDataAttribute('maxselectionsize', $max);
		}

		return $this;
	}
}
