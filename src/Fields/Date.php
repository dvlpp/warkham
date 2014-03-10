<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractGroupField;

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
	 * Create the Date fields
	 *
	 * @return void
	 */
	protected function createChildren()
	{
		$this->nest(array(
			'date' => $this->app['former']->date($this->name.'[date]')->addClass('wkm-date-date'),
			'time' => $this->app['former']->time($this->name.'[time]')->addClass('wkm-date-time'),
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
		$this->$children->$bound($value);

		return $this;
	}
}
