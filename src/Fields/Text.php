<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractField;

/**
 * A basic text field
 */
class Text extends AbstractField
{
  /**
   * Properties to be injected as attributes
   *
   * @var array
   */
  protected $injectedProperties = array('type', 'name', 'value');

  /**
   * The default attributes
   *
   * @var array
   */
  protected $attributes = array(
  	'class' => 'wkm-text',
  );
}