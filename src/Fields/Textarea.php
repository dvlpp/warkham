<?php
namespace Warkham\Fields;

use Former\Form\Fields\Textarea as FormerTextarea;
use Warkham\Traits\WarkhamField;

/**
 * A textarea field
 */
class Textarea extends FormerTextarea
{
	use WarkhamField;

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-textarea',
	);

	/**
	 * Set the interface to wrap the textarea in
	 *
	 * @param string $interface
	 *
	 * @return self
	 */
	public function ui($interface)
	{
		return $this->setDataAttribute('ui', $interface);
	}

	/**
	 * Set the available tools in toolbar
	 *
	 * @param array $toolbar
	 *
	 * @return self
	 */
	public function setToolbar(array $toolbar)
	{
		$possible = ['bold', 'italic', 'heading', 'link', 'image', 'list', 'undo'];
		$toolbar  = array_intersect($possible, $toolbar);

		return $this->setDataAttribute('toolbar', $toolbar);
	}
}
