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
	 * Create the Date fields
	 *
	 * @return void
	 */
	protected function createChildren()
	{
		$this->nest(array(
			'list' => Element::create('ul')->addClass('list-group'),
		));
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
			$li = Element::create('li')->addClass('list-group-item')->nest(array(
				'label' => $this->createLabel($field->getName()),
				'field' => $field,
			));

			$parent->nest($li, $field->getName());
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

		// Store template and create item
		$this->fieldsTemplate = $fields;
		$this->createItem($this->getChild('list'));

		return $this;
	}

	/**
	 * Set the subfields values
	 *
	 * @param array $values
	 */
	public function setValues(array $items = array())
	{
		// Set the value of each child individually
		foreach ($items as $key => $item) {
			foreach ($item as $field => $value) {
				$this->getChild('list')->getChild($field)->getChild('field')->setValue($value);
			}
		}

		return $this;
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
		$button = Element::create('button', $text);
		$this->nest($button, 'button');

		// Create template
		$template = $this->createItem();
		$this->nest($template, 'template');

		return $this;
	}
}