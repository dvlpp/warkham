<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractField;

class Oracle extends AbstractField
{
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