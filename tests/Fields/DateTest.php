<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class DateTest extends WarkhamTestCase
{
	public function testCanCreateDate()
	{
		$field = $this->warkham->date('dummy');

		$this->assertField($field, array(
			'name'  => 'dummy[date]',
			'type'  => 'date',
			'class' => 'wkm-date-date',
		));
		$this->assertField($field, array(
			'name'  => 'dummy[time]',
			'type'  => 'time',
			'class' => 'wkm-date-time',
		));
		$this->assertHtmlStructure(array(
			'tag'        => 'div',
			'attributes' => array(
				'class' => 'wkm-date'
			),
		), $field);
	}

	public function testCanSetMinAndMaxDate()
	{
		$field = $this->warkham->date('dummy')->minDate('1990-01-01')->maxDate('2013-01-01');

		$this->assertField($field, array(
			'name'  => 'dummy[date]',
			'type'  => 'date',
			'class' => 'wkm-date-date',
			'min'   => '1990-01-01',
			'max'   => '2013-01-01',
		));
	}

	public function testCanSetMinAndMaxTime()
	{
		$field = $this->warkham->date('dummy')->minTime('04:00')->maxTime('06:00');

		$this->assertField($field, array(
			'name'  => 'dummy[time]',
			'type'  => 'time',
			'class' => 'wkm-date-time',
			'min'   => '04:00',
			'max'   => '06:00',
		));
	}

	public function testCanSetStep()
	{
		$field = $this->warkham->date('dummy')->step(1);

		$this->assertField($field, array(
			'name'  => 'dummy[time]',
			'type'  => 'time',
			'class' => 'wkm-date-time',
			'step'  => '60',
		));
	}

	public function testCanRemoveTimeField()
	{
		$field = $this->warkham->date('dummy')->withTime(false);

		$this->assertNotContains('dummy[time]', $field->render());
	}
}
