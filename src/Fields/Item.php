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
	 * The format of buttons to use
	 *
	 * @var array
	 */
	protected $buttons = array(
		'addable'    => ['text' => 'Ajouter',   'class' => 'btn btn-primary'],
		'removeable' => ['text' => 'Supprimer', 'class' => 'btn btn-danger'],
	);

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
	//////////////////////////////// ITEMS /////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Nest an item in the group
	 *
	 * @param integer $index
	 * @param boolean $recreate
	 *
	 * @return Element
	 */
	protected function getItem($index = 'new', $recreate = false)
	{
		$identifier = 'list-'.$index;

		// Create item if necessary
		if (!$this->hasChild($identifier) or $recreate) {
			$list = Element::create('ul')->addClass('list-group');
			$this->createItem($list, $index);
			$this->prependChild($list, $identifier, 'list-new');
		}

		return $this->getChild($identifier);
	}

	/**
	 * Create an item from a field
	 *
	 * @param Element|null $parent
	 *
	 * @return Element
	 */
	public function createItem($parent = null, $identifier = 'new')
	{
		// Create parent if we don't have one
		if (!$parent) {
			$parent = Element::create('ul')->addClass('list-group wkm-template');
		}

		// Nest fields we specified
		foreach ($this->fieldsTemplate as $field) {
			$field = clone $field;

			// Append item identifier to field name
			$name = $field->getName();
			$field->name($this->getFieldName($name, $identifier));

			// Create LI element
			$li = $this->createLi(array(
				'label' => $this->createLabel($field->getCreatedId())->class(''),
				'field' => clone $field,
			));

			$parent->nest($li, $field->getName());
		}

		// Add remove button if provided
		if ($this->getAttribute('data-removeable')) {
			$delete = $this->createButton('removeable')->dataAction('remove-item');
			$parent->nest($this->createLi(array(
				'button' => $delete,
			)), 'button');
		}

		return $parent;
	}

	////////////////////////////////////////////////////////////////////
	////////////////////////////// FIELDS //////////////////////////////
	////////////////////////////////////////////////////////////////////

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
		$fields    = (sizeof($arguments) === 1 and is_array($fields)) ? $fields : $arguments;

		// Store template
		if ($fields) {
			$this->fieldsTemplate = $fields;
		}

		// Clear former registered fields
		$this->app['former']->labels = array();
		$this->app['former']->ids    = array();

		// Create list and nest it
		$this->getItem(0, true);

		// Set values
		$this->setValues();

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

	/**
	 * Get the concatenated name of a field
	 *
	 * @param string  $field
	 * @param integer $index
	 *
	 * @return string
	 */
	protected function getFieldName($field, $index)
	{
		return sprintf('%s[%s][%s]', $this->name, $index, $field);
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// BUTTONS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Create a button
	 *
	 * @param string $type
	 *
	 * @return Element
	 */
	protected function createButton($type)
	{
		extract($this->buttons[$type]);

		return Element::create('button', $text)->class($class);
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

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
				$this->getItem($key)->getChild($this->getFieldName($field, $key))->getChild('field')->setValue($value);
			}
		}

		return $this;
	}

	/**
	 * Set an items field as sortable or not
	 *
	 * @param boolean $sortable
	 *
	 * @return self
	 */
	public function sortable($sortable = true)
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
	public function addable($addable = true, $text = 'Ajouter', $class = 'btn btn-primary')
	{
		return $this->addButtonToTemplate('addable', $addable, $text, $class);
	}

	/**
	 * Set an items field's items as removeable
	 *
	 * @param boolean $removeable
	 * @param string  $text
	 *
	 * @return self
	 */
	public function removeable($removeable = true, $text = 'Supprimer', $class = 'btn btn-danger')
	{
		return $this->addButtonToTemplate('removeable', $removeable, $text, $class);
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Add a button to the template
	 *
	 * @param string  $name
	 * @param boolean $enabled
	 * @param string  $text
	 * @param string  $class
	 */
	protected function addButtonToTemplate($name, $enabled, $text, $class)
	{
		$this->setDataAttribute($name, $enabled);
		$this->buttons[$name] = compact('text', 'class');

		// Create button
		if ($name == 'addable') {
			$button = $this->createButton($name)->dataAction('add-item');
			$this->nest($button, 'button');
		} else {
			$this->fields();
		}

		// Create template
		$template = $this->createItem();
		$this->children['template'] = $template;
		$this->setChild($template, 'template');

		return $this;
	}
}