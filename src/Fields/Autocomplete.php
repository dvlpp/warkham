<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractField;
use Warkham\Traits\WithTemplate;

/**
 * A field that autocompletes
 */
class Autocomplete extends AbstractField
{
	use WithTemplate;

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-autocomplete',
	);

	/**
	 * Set the local values
	 *
	 * @param array $dataset
	 */
	public function setDataset(array $dataset = array())
	{
		return $this->setDataAttribute('values', $dataset);
	}

	/**
	 * Set the route for remote values
	 *
	 * @param string $route
	 */
	public function setRemoteRoute($route)
	{
		return $this->setRoute($route);
	}
}
