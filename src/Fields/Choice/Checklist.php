<?php
namespace Warkham\Fields\Choice;

use Former\Form\Fields\Checkbox;
use Warkham\Traits\Choice;
use Warkham\Traits\WarkhamField;

/**
 * Checkboxes implementation of the Choice field
 */
class Checklist extends Checkbox
{
	use Choice;
	use WarkhamField;

	/**
	 * The current selected interface
	 *
	 * @var string
	 */
	protected $interface = 'checklist';

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-checklist',
	);

	/**
	 * Cache of the current values
	 *
	 * @var array
	 */
	protected $values = array();
}