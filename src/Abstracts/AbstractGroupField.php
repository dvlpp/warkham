<?php
namespace Warkham\Abstracts;

use Former\Form\Group;

abstract class AbstractGroupField extends Group
{
	/**
	 * Get the group opener
	 *
	 * @return string
	 */
	public function open()
	{
		return parent::open().parent::getFormattedLabel();
	}

  /**
   * Prints out the opening of the Control Group
   *
   * @return string A control group opening tag
   */
  public function __toString()
  {
  	return $this->render();
  }
}
