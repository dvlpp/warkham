<?php
namespace Warkham\Fields;

use Warkham\Abstracts\AbstractField;

/**
 * A basic text field
 */
class Text extends AbstractField
{
	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-text',
	);
}
