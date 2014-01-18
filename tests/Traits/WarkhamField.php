<?php
namespace Warkham\Traits;

use Warkham\WarkhamTestCase;

class AbstractFieldTest extends WarkhamTestCase
{
	public function testCanSetValueWithUnifiedMethod()
	{
		$field   = $this->getDummyField()->setAvailableValues('test');
		$matcher = $this->assertField($field, array(
			'value' => 'test',
		));
	}
}
