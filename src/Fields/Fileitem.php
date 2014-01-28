<?php
namespace Warkham\Fields;

use Illuminate\Container\Container;

/**
 * An item list of file fields
 */
class Fileitem extends Item
{
	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-items wkm-fileitems',
	);

	/**
	 * Build a new Fileitem
	 *
	 * @param Container $app
	 * @param string    $type
	 * @param string    $name
	 * @param string    $label
	 * @param array     $validations
	 */
	public function __construct(Container $app, $type, $name, $label, $validations)
	{
		parent::__construct($app, $type, $name, $label, $validations);

		// Set base template to file
		$this->fields(
			$app['warkham']->file('file')
		);
	}
}
