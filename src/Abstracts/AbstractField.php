<?php
namespace Warkham\Abstracts;

use Former\Traits\Field;
use Warkham\Traits\WarkhamField;

/**
 * An abstract field class for all fields to extend
 */
abstract class AbstractField extends Field
{
	use WarkhamField;

  /**
   * Properties to be injected as attributes
   *
   * @var array
   */
  protected $injectedProperties = array('type', 'name', 'value');
}