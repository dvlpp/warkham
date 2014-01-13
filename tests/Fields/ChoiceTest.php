<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class ChoiceTest extends WarkhamTestCase
{
	public function testChoiceFieldsDefaultToSelect()
	{
		$choice = $this->warkham->choice('dummy')->options(['foo', 'bar'], 1);

		$this->assertSelect($choice, array(
			'class' => 'wkm-list',
		));
	}

	public function testCanSetToMultipleIfList()
	{
		$choice = $this->warkham->choice('dummy')->options(['foo', 'bar'], 1)->multiple(true);
		$this->assertSelect($choice, array(
			'class'         => 'wkm-list',
			'data-multiple' => true,
		));

		$choice = $this->warkham->choice('dummy')->ui('radio')->multiple(true);
		$this->assertNotContains('data-multiple', $choice->render());
	}

	public function testCanSetValuesOfChoiceField()
	{
		$choice = $this->warkham->choice('dummy')->setAvailableValues(['foo', 'bar']);

		$this->assertSelect($choice, array(
			'class' => 'wkm-list',
		));
	}

	public function testCanMutateToRadios()
	{
		$choice = $this->warkham->choice('dummy')->ui('checklist')->setAvailableValues(['foo', 'bar']);
		$matcher =
			'<label for="dummy_0" class="checkbox"><input class="wkm-checklist" id="dummy_0" type="checkbox" name="dummy_0" value="1">Foo</label>'.
			'<label for="dummy_1" class="checkbox"><input class="wkm-checklist" id="dummy_1" type="checkbox" name="dummy_1" value="1">Bar</label>';

		$this->assertEquals($matcher, $choice->render());
	}

	public function testCanMutateToCheckboxes()
	{
		$choice = $this->warkham->choice('dummy')->ui('radio')->setAvailableValues(['foo', 'bar']);
		$matcher =
			'<label for="dummy2" class="radio"><input class="wkm-radio" id="dummy2" type="radio" name="dummy" value="0">Foo</label>'.
			'<label for="dummy3" class="radio"><input class="wkm-radio" id="dummy3" type="radio" name="dummy" value="1">Bar</label>';

		$this->assertEquals($matcher, $choice->render());
	}

	public function testFailsGracefullyIfIncorrectUi()
	{
		$choice = $this->warkham->choice('dummy')->options(['foo', 'bar'])->ui('foobar');

		$this->assertSelect($choice, array(
			'class' => 'wkm-list',
		));
	}
}
