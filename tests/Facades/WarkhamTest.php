<?php
namespace Warkham\Facades;

use Warkham\WarkhamTestCase;

class WarkhamTest extends WarkhamTestCase
{
	public function testCanUseFacadeToCallCoreClass()
	{
		$field = Warkham::text('dummy')->value('foobar');
		$this->assertField($field);
	}
}
