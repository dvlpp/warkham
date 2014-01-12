<?php
namespace Warkham\Fields\Choice;

use Former\Form\Fields\Select as FormerSelect;
use Warkham\Traits\Choice;

/**
 * Select implementation of the Choice field
 */
class Select extends FormerSelect
{
	use Choice;

	/**
	 * The current selected interface
	 *
	 * @var string
	 */
	protected $interface = 'list';

	/**
	 * Cache of the current values
	 *
	 * @var array
	 */
	protected $values = array();
}