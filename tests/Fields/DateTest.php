<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class DateTest extends WarkhamTestCase
{
	public function testCanCreateDate()
	{
		$field = $this->warkham->date('dummy');

		$this->assertField($field, array(
			'name' => 'dummy[date]',
			'type' => 'date',
		));
		$this->assertField($field, array(
			'name' => 'dummy[time]',
			'type' => 'time',
		));
		$this->assertHtml(array(
			'tag'        => 'div',
			'attributes' => array(
				'class' => 'wkm-date'
			),
		), $field);
	}
}
