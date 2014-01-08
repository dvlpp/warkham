<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class TextareaTest extends WarkhamTestCase
{
	public function testCanCreateTextarea()
	{
		$field = $this->warkham->textarea('dummy');
		$this->assertTextarea($field);
	}

	public function testCanSetInterface()
	{
		$field = $this->warkham->textarea('dummy')->ui('markdown');
		$this->assertTextarea($field, array(
			'data-ui' => 'markdown',
		));
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Assert a string matches a textarea field
	 *
	 * @param string $field
	 * @param array  $attributes
	 *
	 * @return Assertion
	 */
	protected function assertTextarea($field, $attributes = array())
	{
		$attributes = array(
			'tag'        => 'textarea',
			'id'         => 'dummy',
			'attributes' => array_merge(array(
				'class' => 'wkm-textarea',
				'name'  => 'dummy',
			), $attributes),
		);

		return $this->assertHtml($attributes, $field);
	}
}
