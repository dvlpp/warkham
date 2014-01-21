<?php
namespace Warkham\Abstracts;

use Former\Helpers;
use HtmlObject\Element;
use HtmlObject\Traits\Tag;
use Illuminate\Container\Container;

abstract class AbstractGroupField extends Tag
{
	/**
	 * The Container
	 *
	 * @var Container
	 */
	protected $app;

	/**
	 * The field's element
	 *
	 * @var string
	 */
	protected $element = 'div';

	/**
	 * The current label
	 *
	 * @var string
	 */
	protected $label;

	/**
	 * The name of the group
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Whether the element is self closing
	 *
	 * @var boolean
	 */
	protected $isSelfClosing = false;

	/**
	 * Build a new Group field
	 *
	 * @param Container $app
	 * @param string    $label
	 * @param array     $validations
	 */
	public function __construct(Container $app, $type, $name, $label, $validations)
	{
		$this->addClass($app['former.framework']->getGroupClasses());

		$this->app   = $app;
		$this->label = $label ?: $name;
		$this->name  = $name;

		$this->createChildren();
	}

	/**
	 * Hook to create children in the subclass
	 *
	 * @return void
	 */
	abstract protected function createChildren();

	////////////////////////////////////////////////////////////////////
	///////////////////////////// DOM ELEMENTS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Create a label element from a string
	 *
	 * @param string $label
	 *
	 * @return Element
	 */
	protected function createLabel($label, $field = null)
	{
		$label = Helpers::translate($label);
		$label = Element::create('label', $label)->for($field ?: strtolower($label));
		$label->addClass($this->app['former.framework']->getLabelClasses());

		return $label;
	}

	/**
	 * Render the group
	 *
	 * @return string
	 */
	public function render()
	{
		// Create label
		$label = $this->createLabel($this->label, $this->name);

		// Create wrapping div
		$children = $this->renderChildren();
		$children = $this->app['former.framework']->wrapField($children);

		return $this->open().$label.$children.$this->close();
	}
}
