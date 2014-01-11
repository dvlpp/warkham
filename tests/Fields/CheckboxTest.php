<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class CheckboxTest extends WarkhamTestCase
{
	public function testHasDefaultCheckboxClass()
	{
		$field = $this->warkham->checkbox('dummy');

		$this->assertField($field, array(
			'type'  => 'checkbox',
			'class' => 'wkm-checkbox',
		));
	}

	public function testCanHaveLabel()
	{
		$field = $this->warkham->checkbox('dummy')->text('foobar')->render();
		$checkbox = $this->matchField(array(
			'type'  => 'checkbox',
			'class' => 'wkm-checkbox',
		));
		$label = array(
			'tag'        => 'label',
			'content'   => 'foobar',
			'attributes' => array(
				'for' => 'dummy',
			),
		);

		$this->assertHtml($checkbox, $field);
		$this->assertHtml($label, $field);
	}

	public function testCanCheckCheckbox()
	{
		$field = $this->warkham->checkbox('dummy')->check(false);
		$this->assertField($field, array(
			'type'    => 'checkbox',
			'class'   => 'wkm-checkbox',
		));

		$this->resetLabels();
		$field = $this->warkham->checkbox('dummy')->check(true);
		$this->assertField($field, array(
			'type'    => 'checkbox',
			'class'   => 'wkm-checkbox',
			'checked' => 'checked',
		));
	}
}
