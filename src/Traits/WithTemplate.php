<?php
namespace Warkham\Traits;

/**
 * A field that can generate tempaltes for Javascript to use
 */
trait WithTemplate
{
	/**
	 * The stored template HTML
	 *
	 * @var string
	 */
	protected $template;

	/**
	 * Set the template to use for autocomplete
	 *
	 * @param string $template
	 */
	public function setTemplate($template)
	{
		$this->template = $template;

		return $this;
	}

	/**
	 * Render the field with an hidden template next to it
	 *
	 * @return string
	 */
	public function render()
	{
		$template = $this->template
			? '<div class="wkm-template" for="' .$this->id. '">' .$this->template. '</div>'
			: '';

		return parent::render().$template;
	}
}
