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
		$this->assertHtml(array(
			'tag'        => 'div',
			'attributes' => array(
				'class' => 'wkm-date'
			),
		), $field);
	}

	public function testCanSetMinAndMaxDate()
	{
		$field = $this->warkham->date('dummy')->min('1990-01-01')->max('2013-01-01');

		$this->assertField($field, array(
			'name'  => 'dummy[date]',
			'type'  => 'date',
			'class' => 'wkm-date-date',
			'min'   => '1990-01-01',
			'max'   => '2013-01-01',
		));
	}
}
