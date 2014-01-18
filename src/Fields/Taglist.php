<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractField;

/**
 * An aggregate of fields
 */
class Taglist extends AbstractField
{
	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-taglist',
	);

	////////////////////////////////////////////////////////////////////
	////////////////////////// BEHAVIOR OVERRIDES //////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Override of setValue to accept an array
	 *
	 * @param array $values
	 */
	public function setValue(array $values = array())
	{
		return $this->setTags($values);
	}

	/**
	 * Override of setValue to accept an array
	 *
	 * @param array $values
	 */
	public function forceValue(array $values = array())
	{
		return $this->setTags($values);
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////// FIELD-SPECIFIC METHODS ////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set the current tags
	 *
	 * @param array $values
	 */
	public function setTags(array $values = array())
	{
		return $this->setDataAttribute('tags', $values);
	}

	/**
	 * Set the available tags
	 *
	 * @param array $tags
	 */
	public function setDataset(array $tags = array())
	{
		return $this->setDataAttribute('dataset', $tags);
	}

	/**
	 * Set the maximum number of tags
	 *
	 * @param integer $max
	 */
	public function setMaxSelectionSize($max)
	{
		return $this->setDataAttribute('maxselectionsize', $max);
	}

	/**
	 * Allow creation of new tags
	 *
	 * @param boolean $allowed
	 */
	public function allowCreate($allowed)
	{
		return $this->setDataAttribute('allowcreate', $allowed);
	}
}
