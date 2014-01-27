<?php
namespace Warkham\Fields;

use Warkham\WarkhamTestCase;

class ItemTest extends WarkhamTestCase
{
	public function testCanCreateItemField()
	{
		$items = $this->warkham->items('items')
			->fields(array(
				$this->warkham->text('dummy'),
				$this->warkham->number('number'),
			));
		$matcher =
			'<div class="wkm-items">'.
				'<label for="items">Items</label>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="dummy[new]">Dummy[new]</label>'.
						'<input class="wkm-text form-control" id="dummy[new]" type="text" name="dummy[new]">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number[new]">Number[new]</label>'.
						'<input class="form-control" id="number[new]" type="number" name="number[new]">'.
					'</li>'.
				'</ul>'.
			'</div>';

		$this->assertEquals($matcher, $items->render());
	}

	public function testCanCreateItemFieldWithMultipleItems()
	{
		$items = $this->warkham->items('items')
			->fields(array(
				$this->warkham->text('dummy'),
				$this->warkham->number('number'),
			))
			->setValues(array(
				['dummy' => 'foo', 'number' => 1],
				['dummy' => 'bar', 'number' => 2],
			));
		$matcher =
			'<div class="wkm-items">'.
				'<label for="items">Items</label>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="dummy[0]">Dummy[0]</label>'.
						'<input class="wkm-text form-control" id="dummy[0]" type="text" name="dummy[0]" value="foo">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number[0]">Number[0]</label>'.
						'<input class="form-control" id="number[0]" type="number" name="number[0]" value="1">'.
					'</li>'.
				'</ul>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="dummy[1]">Dummy[1]</label>'.
						'<input class="wkm-text form-control" id="dummy[1]" type="text" name="dummy[1]" value="bar">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number[1]">Number[1]</label>'.
						'<input class="form-control" id="number[1]" type="number" name="number[1]" value="2">'.
					'</li>'.
				'</ul>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="dummy[new]">Dummy[new]</label>'.
						'<input class="wkm-text form-control" id="dummy[new]" type="text" name="dummy[new]">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number[new]">Number[new]</label>'.
						'<input class="form-control" id="number[new]" type="number" name="number[new]">'.
					'</li>'.
				'</ul>'.
			'</div>';

		$this->assertEquals($matcher, $items->render());
	}

	public function testCanSetValueOnSubfields()
	{
		$items = $this->warkham->items('items')
			->fields(array(
				$this->warkham->text('dummy'),
				$this->warkham->number('number'),
			))
			->setValues(array(
				['dummy' => 'Foobar', 'number' => 23]
			));
		$matcher =
			'<div class="wkm-items">'.
				'<label for="items">Items</label>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="dummy[0]">Dummy[0]</label>'.
						'<input class="wkm-text form-control" id="dummy[0]" type="text" name="dummy[0]" value="Foobar">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number[0]">Number[0]</label>'.
						'<input class="form-control" id="number[0]" type="number" name="number[0]" value="23">'.
					'</li>'.
				'</ul>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="dummy[new]">Dummy[new]</label>'.
						'<input class="wkm-text form-control" id="dummy[new]" type="text" name="dummy[new]">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number[new]">Number[new]</label>'.
						'<input class="form-control" id="number[new]" type="number" name="number[new]">'.
					'</li>'.
				'</ul>'.
			'</div>';

		$this->assertEquals($matcher, $items->render());
	}

	public function testCanSetAsSortable()
	{
		$items = $this->warkham->items('items')->sortable(true);

		$this->assertHtml(array(
			'tag'        => 'div',
			'attributes' => array(
				'class'         => 'wkm-items',
				'data-sortable' => 'true',
			),
		), $items);
	}

	public function testCanSetAddableAndTemplate()
	{
		$items = $this->warkham->items('items')
			->fields(array(
				$this->warkham->text('dummy'),
				$this->warkham->number('number'),
			))
			->addable();

		$this->assertHtml(array(
			'tag'        => 'div',
			'attributes' => array(
				'class'        => 'wkm-items',
				'data-addable' => 'true',
			),
		), $items);
		$this->assertHtml(array(
			'tag'        => 'button',
			'content'    => 'Ajouter',
			'attributes' => array(
				'class' => 'btn',
			),
		), $items);

		$matcher =
			'<ul class="list-group wkm-template">'.
				'<li class="list-group-item">'.
					'<label for="dummy[new]-2">Dummy[new]-2</label>'.
					'<input class="wkm-text form-control" id="dummy[new]-2" type="text" name="dummy[new]">'.
				'</li>'.
				'<li class="list-group-item">'.
					'<label for="number[new]-2">Number[new]-2</label>'.
					'<input class="form-control" id="number[new]-2" type="number" name="number[new]">'.
				'</li>'.
			'</ul>';
		$this->assertContains($matcher, $items->render());
	}

	public function testCanSetRemoveable()
	{
		$items = $this->warkham->items('items')
			->fields(array(
				$this->warkham->text('dummy'),
			))
			->removeable(true, 'NOPE');

		$this->assertHtml(array(
			'tag'        => 'div',
			'attributes' => array(
				'class'           => 'wkm-items',
				'data-removeable' => 'true',
			),
		), $items);

		$matcher =
			'<ul class="list-group wkm-template">'.
				'<li class="list-group-item">'.
					'<label for="dummy[new]-2">Dummy[new]-2</label>'.
					'<input class="wkm-text form-control" id="dummy[new]-2" type="text" name="dummy[new]">'.
				'</li>'.
				'<li class="list-group-item">'.
					'<button class="btn btn-danger" data-action="remove-item">NOPE</button>'.
				'</li>'.
			'</ul>';

		$this->assertContains($matcher, $items->render());
	}
}
