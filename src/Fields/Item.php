<?php
namespace Warkham\Fields;

use HtmlObject\Element;
use Warkham\Abstracts\AbstractGroupField;

/**
 * A list of items with multiple fields
 */
class Item extends AbstractGroupField
{
	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-items',
	);

	/**
	 * A template for the inner fields
	 *
	 * @var array
	 */
	protected $fieldsTemplate = array();

	/**
	 * The values populated to the fields
	 *
	 * @var array
	 */
	protected $values = array();

	/**
	 * The text to use to remove items
	 *
	 * @var string
	 */
	protected $removeableText;

	/**
	 * Create the Date fields
	 *
	 * @return void
	 */
	protected function createChildren()
	{
		// ...
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// CHILD FIELDS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Create an item from a field
	 *
	 * @param Element|null $parent
	 *
	 * @return Element
	 */
	public function createItem($parent = null)
	{
		// Create parent if we don't have one
		if (!$parent) {
			$parent = Element::create('ul')->addClass('list-group wkm-template');
		}

		// Nest fields we specified
		foreach ($this->fieldsTemplate as $field) {
			$li = $this->createLi(array(
				'label' => $this->createLabel($field->getId())->class(''),
				'field' => $field,
			));

			$parent->nest($li, $field->getName());
		}

		// Add remove button if provided
		if ($this->getAttribute('data-removeable')) {
			$delete = Element::create('button', $this->removeableText)->class('btn btn-danger')->dataAction('remove-item');
			$parent->nest($this->createLi(array(
				'button' => $delete,
			)), 'button');
		}

		return $parent;
	}

	/**
	 * Bind fields to the Item
	 *
	 * @param array $fields
	 *
	 * @return self
	 */
	public function fields($fields = array())
	{
		// Get fields to bind
		$arguments = func_get_args();
		$fields    = sizeof($arguments) === 1 ? $fields : $arguments;

		// Store template
		if ($fields) {
			$this->fieldsTemplate = $fields;
		}

		// Create items
		$list = Element::create('ul')->addClass('list-group');
		$this->createItem($list);
		$this->setChild($list, 'list');

		return $this;
	}

	/**
	 * Set the subfields values
	 *
	 * @param array $values
	 */
	public function setValues(array $items = array())
	{
		if ($items) {
			$this->values = $items;
		}

		// Set the value of each child individually
		foreach ($this->values as $key => $item) {
			foreach ($item as $field => $value) {
				$this->getChild('list')->getChild($field)->getChild('field')->setValue($value);
			}
		}

		return $this;
	}

	/**
	 * Create a list element
	 *
	 * @param array $contents
	 *
	 * @return Element
	 */
	protected function createLi(array $contents = array())
	{
		return Element::create('li')->addClass('list-group-item')->nest($contents);
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set an items field as sortable or not
	 *
	 * @param boolean $sortable
	 *
	 * @return self
	 */
	public function sortable($sortable)
	{
		return $this->setDataAttribute('sortable', $sortable);
	}

	/**
	 * Set an items field as addable or not
	 *
	 * @param boolean $addable
	 * @param string  $text
	 *
	 * @return self
	 */
	public function addable($addable, $text = 'Ajouter')
	{
		$this->setDataAttribute('addable', $addable);

		// Create button
		$button = Element::create('button', $text)->class('btn')->dataAction('add-item');
		$this->nest($button, 'button');

		// Create template
		$template = $this->createItem();
		$this->nest($template, 'template');

		return $this;
	}

	/**
	 * Set an items field's items as removeable
	 *
	 * @param boolean $removeable
	 * @param string  $text
	 *
	 * @return self
	 */
	public function removeable($removeable, $text = 'Supprimer')
	{
		$this->setDataAttribute('removeable', $removeable);
		$this->removeableText = $text;

		// Recreate items
		$this->fields();

		// Recreate template
		$template = $this->createItem();
		$this->setChild($template, 'template');

		return $this;
	}
}