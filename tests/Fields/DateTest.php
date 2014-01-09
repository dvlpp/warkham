<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class DateTest extends WarkhamTestCase
{
	public function testCanCreateDate()
	{
		$field = $this->warkham->date('dummy');
		dd($field->render());
	}
}
