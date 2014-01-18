<?php
namespace Warkham\Fields;

use Warkham\Traits\WarkhamField;
use Warkham\Traits\WithTemplate;

class Oracle extends Text
{
	use WarkhamField;
	use WithTemplate;

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-oracle',
	);

	/**
	 * Set the minimum length of the request to make
	 *
	 * @param integer $length
	 */
	public function setQueryMinLength($length)
	{
		return $this->setDataAttribute('queryminlength', $length);
	}

	/**
	 * Set the route to use to fetch values
	 *
	 * @param string $route
	 */
	public function setRemoteRoute($route)
	{
		return $this->setRoute($route);
	}
}
