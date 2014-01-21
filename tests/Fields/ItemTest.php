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
						'<label for="dummy">Dummy</label>'.
						'<input class="wkm-text form-control" id="dummy" type="text" name="dummy">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number">Number</label>'.
						'<input class="form-control" id="number" type="number" name="number">'.
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
						'<label for="dummy">Dummy</label>'.
						'<input class="wkm-text form-control" id="dummy" type="text" name="dummy" value="Foobar">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="number">Number</label>'.
						'<input class="form-control" id="number" type="number" name="number" value="23">'.
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
}
