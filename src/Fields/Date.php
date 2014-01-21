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
  public function __construct(Container $app, $name, $label, $validations)
	{
		parent::__construct($app, $label, $validations);

		$this->nest(array(
			'date' => $app['former']->date($name.'[date]')->addClass('wkm-date-date'),
			'time' => $app['former']->time($name.'[time]')->addClass('wkm-date-time'),
		));
	}

	/**
	 * Set the step for the time
	 *
	 * @param integer $step Step in minutes
	 *
	 * @return self
	 */
	public function step($step)
	{
		$this->time->step($step * 60);

		return $this;
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////////// BOUNDS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set a date as maximum date
	 *
	 * @param string $date
	 *
	 * @return self
	 */
	public function maxDate($date)
	{
		return $this->setChildBound('date', 'max', $date);
	}

	/**
	 * Set a date as minimum date
	 *
	 * @param string $date
	 *
	 * @return self
	 */
	public function minDate($date)
	{
		return $this->setChildBound('date', 'min', $date);
	}

	/**
	 * Set a time as maximum time
	 *
	 * @param string $time
	 *
	 * @return self
	 */
	public function maxTime($time)
	{
		return $this->setChildBound('time', 'max', $time);
	}

	/**
	 * Set a time as minimum time
	 *
	 * @param string $time
	 *
	 * @return self
	 */
	public function minTime($time)
	{
		return $this->setChildBound('time', 'min', $time);
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set a bound on a children
	 *
	 * @param string $children
	 * @param string $bound
	 * @param string $value
	 */
	protected function setChildBound($children, $bound, $value)
	{
		$this->{$children}->{$bound}($value);

		return $this;
	}
}
