<?php
namespace Warkham\Fields;

use HtmlObject\Element;
use Illuminate\Container\Container;
use Warkham\Abstracts\AbstractField;

/**
 * A simple checkbox
 */
class Checkbox extends AbstractField
{
	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-checkbox',
	);

	/**
	 * Encore text type
	 *
	 * @param Container $app
	 * @param strign    $type
	 * @param string    $name
	 * @param string    $label
	 * @param string    $value
	 * @param array     $attributes
	 */
	public function __construct(Container $app, $type, $name, $label, $value, $attributes)
	{
		parent::__construct($app, $type, $name, $label, $value, $attributes);

		$this->type = 'checkbox';
	}

	/**
	 * The Checkbox's text
	 *
	 * @var string
	 */
	protected $text;

	/**
	 * Appends a label to the checkbox
	 *
	 * @param string $label
	 *
	 * @return self
	 */
	public function text($text)
	{
		$this->text = Element::create('label', $text);

		return $this;
	}

	/**
	 * Check or not the checkbox
	 *
	 * @param boolean $checked
	 *
	 * @return self
	 */
	public function check($checked)
	{
		if ($checked) {
			$this->checked('checked');
		} else {
			$this->removeAttribute('checked');
		}

		return $this;
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// DOM METHODS //////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Render the label alongside the checkbox
	 *
	 * @return string
	 */
	public function render()
	{
		$checkbox = parent::render();

		// If we have a label, wrap it in it
		if ($this->text) {
			$checkbox .= $this->text->for($this->id)->render();
		}

		return $checkbox;
	}
}
