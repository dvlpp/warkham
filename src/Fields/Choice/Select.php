<?php
namespace Warkham\Fields\Choice;

use Former\Form\Fields\Select as FormerSelect;
use Warkham\Traits\Choice;
use Warkham\Traits\WarkhamField;

/**
 * Select implementation of the Choice field
 */
class Select extends FormerSelect
{
	use Choice;
	use WarkhamField;

	/**
	 * The current selected interface
	 *
	 * @var string
	 */
	protected $interface = 'list';

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-list',
	);

	/**
	 * Cache of the current values
	 *
	 * @var array
	 */
	protected $values = array();
}