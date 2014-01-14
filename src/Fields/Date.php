<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractGroupField;
use Illuminate\Container\Container;

/**
 * A date field
 */
class Date extends AbstractGroupField
{
	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-date',
	);

	/**
	 * Build a new Date field
	 *
	 * @param Container $app
	 * @param string    $label
	 * @param array     $validations
	 */
  public function __construct(Container $app, $type, $name, $label, $validations)
	{
		parent::__construct($app, $label, $validations);

		$this->nest(array(
			'date' => $app['former']->date($name.'[date]'),
			'time' => $app['former']->time($name.'[time]'),
		));
	}
}
