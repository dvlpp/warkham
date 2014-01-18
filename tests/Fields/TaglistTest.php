<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class TaglistTest extends WarkhamTestCase
{
	public function testHasDefaultTaglistClass()
	{
		$field = $this->warkham->taglist('dummy');

		$this->assertField($field, array(
			'class' => 'wkm-taglist',
		));
	}

	public function testCanSetDataAttributes()
	{
		$field = $this->warkham->taglist('dummy')
			->setTags(['foo', 'bar'])
			->setDataset(['baz', 'qux'])
			->setMaxSelectionSize(3)
			->allowCreate(false);

		$this->assertField($field, array(
			'class'                 => 'wkm-taglist',
			'data-tags'             => '["foo","bar"]',
			'data-dataset'          => '["baz","qux"]',
			'data-maxselectionsize' => '3',
			'data-allowcreate'      => 'false',
		));
	}

	public function testCanSetValues()
	{
		$field = $this->warkham->taglist('dummy')->setValue(['foo', 'bar']);
		$this->assertField($field, array(
			'data-tags' => '["foo","bar"]',
		));

		$this->resetLabels();
		$field = $this->warkham->taglist('dummy')->forceValue(['foo', 'bar']);
		$this->assertField($field, array(
			'data-tags' => '["foo","bar"]',
		));
	}
}
