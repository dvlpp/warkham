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
	 * Whether values are to be fetched remotly or not
	 *
	 * @param boolean $remote
	 *
	 * @return self
	 */
	public function remote($remote)
	{
		$this->setDataAttribute('remote', $remote);

		// If we don't want to fetch data via AJAX, get them now
		$route = $this->getAttribute('data-url');
		if (!$remote and $route) {
			$data = $this->app['files']->getRemote($route);
			$data = json_decode($data, true);

			$this->options($data);
		} else {
			return $this->mutateTo('text')->addClass('wkm-oracle');
		}

		return $this;
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