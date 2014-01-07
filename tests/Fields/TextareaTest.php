<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class TextareaTest extends WarkhamTestCase
{
	public function testCanCreateTextarea()
	{
		$field = $this->warkham->textarea('dummy');

		$this->assertHtml(array(
			'tag'        => 'textarea',
			'id'         => 'dummy',
			'attributes' => array(
				'name' => 'dummy',
			),
		), $field);
	}
}