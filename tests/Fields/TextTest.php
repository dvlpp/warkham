<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class TextTest extends WarkhamTestCase
{
	public function testHasDefaultTextClass()
	{
		$field = $this->warkham->text('dummy');
		$this->assertField($field, array(
			'class' => 'wkm-text',
		));
	}
}
