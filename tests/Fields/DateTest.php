<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class DateTest extends WarkhamTestCase
{
	public function testCanCreateDate()
	{
		$this->markTestSkipped('Not working for now');

		$field = $this->warkham->date('dummy');
		dd($field->render());
	}
}
