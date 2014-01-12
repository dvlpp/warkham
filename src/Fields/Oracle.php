<?php
namespace Warkham\Fields;

use Former\Form\Fields\Select;
use Warkham\Traits\WarkhamField;

class Oracle extends Select
{
	use WarkhamField;

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-oracle',
	);

	/**
	 * Set the route to use to fetch values
	 *
	 * @param string $route
	 */
	public function setAvailableValuesRoute($route)
	{
		return $this->setRoute($route);
	}
}