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

	////////////////////////////////////////////////////////////////////
	///////////////////////////// CHILD FIELDS /////////////////////////
	////////////////////////////////////////////////////////////////////

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

		foreach ($fields as $field) {
			$li = Element::create('li')->addClass('list-group-item')->nest(array(
				'label' => $this->createLabel($field->getName()),
				'field' => $field,
			));

			$this->getChild('list')->nest($li, $field->getName());
		}

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
}