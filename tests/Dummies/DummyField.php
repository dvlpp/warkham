<?php
namespace Warkham\Dummies;

use Warkham\Abstracts\AbstractField;

class DummyField extends AbstractField
{
  /**
   * Properties to be injected as attributes
   *
   * @var array
   */
  protected $injectedProperties = array('type', 'name', 'value');
}
