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
	public function __construct(Container $app, $label, $validations)
	{
		$this->app = $app;
		$this->addClass($this->app['former.framework']->getGroupClasses());
		$this->label = $label;
	}

	/**
	 * Set the Group's label
	 *
	 * @param string $label
	 */
	public function setLabel($label)
	{
		// Create label
		if (!$label instanceof Element) {
			$label = Helpers::translate($label);
		}

		// Set framework classes

		// Bind as child
		$this->setChild($label, 'label');
	}

	public function render()
	{
		// Create label
		$label = Helpers::translate($this->label);
		$label = Element::create('label', $label)->for($label);
		$label->addClass($this->app['former.framework']->getLabelClasses());

		// Create wrapping div
		$children = $this->renderChildren();
		$children = $this->app['former.framework']->wrapField($children);

		return $this->open().$label.$children.$this->close();
	}
}
