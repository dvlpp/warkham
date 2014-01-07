<?php
namespace Warkham\Abstracts;

use Warkham\WarkhamTestCase;

class AbstractFieldTest extends WarkhamTestCase
{
	public function testExtendsFormerFieldObject()
	{
		$field   = $this->getDummyField()->class('foobar');
		$matcher = $this->assertField($field, array(
			'class' => 'foobar',
		));
	}

	public function testCanEnableField()
	{
		$field   = $this->getDummyField()->enable(true);
		$matcher = $this->assertField($field, array(
			'data-disabled' => 'false',
		));
	}

	public function testCanDisableField()
	{
		$field   = $this->getDummyField()->enable(false);
		$matcher = $this->assertField($field, array(
			'data-disabled' => 'true',
		));
	}

	public function testCanAddClass()
	{
		$field   = $this->getDummyField()->class('foobar')->addClass('baz');
		$matcher = $this->assertField($field, array(
			'class' => 'foobar baz',
		));
	}

	public function testCanSetValue()
	{
		$field   = $this->getDummyField()->setValue('test');
		$matcher = $this->assertField($field, array(
			'value' => 'test',
		));
	}
}
