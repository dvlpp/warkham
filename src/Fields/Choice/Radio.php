<?php
namespace Warkham\Fields\Choice;

use Former\Form\Fields\Radio as FormerRadio;
use Warkham\Traits\Choice;
use Warkham\Traits\WarkhamField;

/**
 * Radios implementation of the Choice field
 */
class Radio extends FormerRadio
{
	use Choice;
	use WarkhamField;

	/**
	 * The current selected interface
	 *
	 * @var string
	 */
	protected $interface = 'radio';

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-radio',
	);

	/**
	 * Cache of the current values
	 *
	 * @var array
	 */
	protected $values = array();
}
