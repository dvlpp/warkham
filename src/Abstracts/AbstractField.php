<?php
namespace Warkham\Abstracts;

use Former\Traits\Field;
use Illuminate\Container\Container;
use Warkham\Traits\WarkhamField;

/**
 * An abstract field class for all fields to extend
 */
abstract class AbstractField extends Field
{
	use WarkhamField;

	/**
	 * Properties to be injected as attributes
	 *
	 * @var array
	 */
	protected $injectedProperties = array('type', 'name', 'value');

	/**
	 * Encore text type
	 *
	 * @param Container $app
	 * @param strign    $type
	 * @param string    $name
	 * @param string    $label
	 * @param string    $value
	 * @param array     $attributes
	 */
	public function __construct(Container $app, $type, $name, $label, $value, $attributes)
	{
		parent::__construct($app, $type, $name, $label, $value, $attributes);

		$this->type = 'text';
	}
}
