<?php
namespace Warkham\Fields\Choice;

use Former\Form\Fields\Radio as FormerRadio;
use Warkham\Traits\Choice;

/**
 * Radios implementation of the Choice field
 */
class Radio extends FormerRadio
{
	use Choice;

	/**
	 * The current selected interface
	 *
	 * @var string
	 */
	protected $interface = 'radio';

	/**
	 * Cache of the current values
	 *
	 * @var array
	 */
	protected $values = array();
}