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
	 * The field's element
	 *
	 * @var string
	 */
	protected $element = 'div';

  /**
   * Whether the element is self closing
   *
   * @var boolean
   */
  protected $isSelfClosing = false;

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
  public function __construct(Container $app, $label, $validations)
	{
		parent::__construct($app, $label, $validations);

		$this->nest(array(
			'date' => $app['warkham']->input('date', $label),
			'time' => $app['warkham']->input('time', $label),
		));
	}
}
