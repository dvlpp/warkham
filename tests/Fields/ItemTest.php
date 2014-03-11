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
			'</div>';

		$this->assertHtml($matcher, $items->render());
	}

	public function testCanSetCustomLabelsAndNames()
	{
		$items = $this->warkham->items('items')
			->fields(array(
				$this->warkham->text('dummy')->name('texte')->label('LETEXTE'),
				$this->warkham->number('number')->name('nombre')->label('LENOMBRE'),
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
						'<label for="items[1][texte]">LETEXTE</label>'.
						'<input class="wkm-text form-control" id="items[1][texte]" type="text" name="items[1][texte]"/>'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="items[1][nombre]">LENOMBRE</label>'.
						'<input class="form-control" id="items[1][nombre]" type="number" name="items[1][nombre]"/>'.
					'</li>'.
				'</ul>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="items[0][texte]">LETEXTE</label>'.
						'<input class="wkm-text form-control" id="items[0][texte]" type="text" name="items[0][texte]"/>'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="items[0][nombre]">LENOMBRE</label>'.
						'<input class="form-control" id="items[0][nombre]" type="number" name="items[0][nombre]"/>'.
					'</li>'.
				'</ul>'.
			'</div>';

		$this->assertHtml($matcher, $items->render());
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
						'<label for="items[1][dummy]">Dummy</label>'.
						'<input class="wkm-text form-control" id="items[1][dummy]" type="text" name="items[1][dummy]" value="bar">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="items[1][number]">Number</label>'.
						'<input class="form-control" id="items[1][number]" type="number" name="items[1][number]" value="2">'.
					'</li>'.
				'</ul>'.
				'<ul class="list-group">'.
					'<li class="list-group-item">'.
						'<label for="items[0][dummy]">Dummy</label>'.
						'<input class="wkm-text form-control" id="items[0][dummy]" type="text" name="items[0][dummy]" value="foo">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="items[0][number]">Number</label>'.
						'<input class="form-control" id="items[0][number]" type="number" name="items[0][number]" value="1">'.
					'</li>'.
				'</ul>'.
			'</div>';

		$this->assertHtml($matcher, $items->render());
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
						'<label for="items[0][dummy]">Dummy</label>'.
						'<input class="wkm-text form-control" id="items[0][dummy]" type="text" name="items[0][dummy]" value="Foobar">'.
					'</li>'.
					'<li class="list-group-item">'.
						'<label for="items[0][number]">Number</label>'.
						'<input class="form-control" id="items[0][number]" type="number" name="items[0][number]" value="23">'.
					'</li>'.
				'</ul>'.
			'</div>';

		$this->assertHtml($matcher, $items->render());
	}

	public function testCanSetAsSortable()
	{
		$items = $this->warkham->items('items')->sortable(true);

		$this->assertHtmlStructure(array(
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

		$this->assertHtmlStructure(array(
			'tag'        => 'div',
			'attributes' => array(
				'class'        => 'wkm-items',
				'data-addable' => 'true',
			),
		), $items);
		$this->assertHtmlStructure(array(
			'tag'        => 'button',
			'content'    => 'Ajouter',
			'attributes' => array(
				'class' => 'btn',
			),
		), $items);

		$matcher =
			'<ul class="list-group wkm-template">'.
				'<li class="list-group-item">'.
					'<label for="items[new][dummy]">Dummy</label>'.
					'<input class="wkm-text form-control" id="items[new][dummy]" type="text" name="items[new][dummy]">'.
				'</li>'.
				'<li class="list-group-item">'.
					'<label for="items[new][number]">Number</label>'.
					'<input class="form-control" id="items[new][number]" type="number" name="items[new][number]">'.
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
			->removeable(true, 'NOPE', 'btn-NOPE');

		$this->assertHtmlStructure(array(
			'tag'        => 'div',
			'attributes' => array(
				'class'           => 'wkm-items',
				'data-removeable' => 'true',
			),
		), $items);

		$matcher =
			'<ul class="list-group wkm-template">'.
				'<li class="list-group-item">'.
					'<label for="items[new][dummy]">Dummy</label>'.
					'<input class="wkm-text form-control" id="items[new][dummy]" type="text" name="items[new][dummy]">'.
				'</li>'.
				'<li class="list-group-item"><button class="btn-NOPE" data-action="remove-item">NOPE</button></li>'.
			'</ul>';

		$this->assertContains($matcher, $items->render());
	}
}
