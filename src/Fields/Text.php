<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractField;

/**
 * A basic text field
 */
class Text extends AbstractField
{
	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-text',
	);

	/**
	 * Add a validation mask to the field
	 *
	 * @param string $validation
	 *
	 * @return self
	 */
	public function mask($validation)
	{
		return $this->setDataAttribute('mask', $validation);
	}
}
