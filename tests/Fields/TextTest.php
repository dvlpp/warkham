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

	public function testCanSetMaskAttribute()
	{
		$field = $this->warkham->text('dummy')->mask('integer');

		$this->assertField($field, array(
			'class'     => 'wkm-text',
			'data-mask' => 'integer',
		));
	}
}
