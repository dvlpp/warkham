<?php
namespace Warkham\Traits;

use Warkham\WarkhamTestCase;

class WithTemplateTest extends WarkhamTestCase
{
	public function testCanSetTemplate()
	{
		$field = $this->getDummyField('DummyTemplateField')->setTemplate('<p>{{value}}</p>');

		$this->assertNotContains('template="<p>{{value}}</p>"', $field->render());
		$this->assertHtml(array(
			'tag' => 'div',
			'attributes' => array(
				'for'   => 'dummy',
				'class' => 'wkm-template',
			),
			'child' => array(
				'tag'     => 'p',
				'content' => '{{value}}',
			),
		), $field);
	}
}