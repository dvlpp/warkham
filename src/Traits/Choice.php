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

		// Get the name of the class to call
		$classes = array(
			'radio'     => 'Radio',
			'checklist' => 'Checklist',
			'list'      => 'Select',
		);

		// Get the type to assign it
		$types = array(
			'radio'     => 'radio',
			'checklist' => 'checkbox',
			'list'      => 'select',
		);

		// Create
		$field = 'Warkham\Fields\Choice\\'.$classes[$choice];
		$field = new $field(
			$this->app,
			$types[$choice],
			$this->name,
			$this->label,
			array(),
			null,
			array()
		);

		// Pass values and class
		$field->setAvailableValues($this->values);

		// Add Framework classes
		$this->currentFramework()->getFieldClasses($field, []);

		return $field;
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
		}
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
			return $this->setDataAttribute('multiple', $multiple);
		}

		return $this;
	}
}