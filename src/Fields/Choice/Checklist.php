<?php
namespace Warkham\Fields\Choice;

use Former\Form\Fields\Checkbox;
use Warkham\Traits\Choice;

/**
 * Checkboxes implementation of the Choice field
 */
class Checklist extends Checkbox
{
	use Choice;

	/**
	 * The current selected interface
	 *
	 * @var string
	 */
	protected $interface = 'checklist';

	/**
	 * Cache of the current values
	 *
	 * @var array
	 */
	protected $values = array();
}