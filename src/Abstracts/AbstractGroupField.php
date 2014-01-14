<?php
namespace Warkham\Abstracts;

use HtmlObject\Element;
use HtmlObject\Traits\Tag;
use Illuminate\Container\Container;

abstract class AbstractGroupField extends Tag
{
	protected $app;

	/**
	 * The field's element
	 *
	 * @var string
	 */
	protected $element = 'div';

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
  }
}
