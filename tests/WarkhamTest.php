<?php
namespace Warkham;

class WarkhamTest extends WarkhamTestCase
{
	public function testCanCallOriginalFormerMethods()
	{
		$this->warkham->macro('foo', function () {
			return 'bar';
		});

		$macro = $this->warkham->getMacro('foo');

		$this->assertEquals('bar', $macro());
	}
}
