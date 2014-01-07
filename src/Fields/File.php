<?php
namespace Warkham\Fields;

use Former\Form\Fields\File as FormerFile;
use Illuminate\Support\Str;
use Warkham\Traits\WarkhamField;

/**
 * A file input
 */
class File extends FormerFile
{
	use WarkhamField;

	/**
	 * The input type
	 *
	 * @var string
	 */
	protected $type = 'file';

	/**
	 * The default attributes
	 *
	 * @var array
	 */
	protected $attributes = array(
		'class' => 'wkm-file',
	);

	/**
	 * Set the file field as multiple or not
	 *
	 * @param boolean $multiple
	 *
	 * @return self
	 */
	public function multiple($multiple)
	{
		return $this->setDataAttribute('multiple', $multiple);
	}

	/**
	 * Set the route endpoint
	 *
	 * @param string $route
	 *
	 * @return self
	 */
	public function uploadRoute($route)
	{
		// Find route
		$route = Str::contains('@', $route) ? $this->app['url']->controller($route) : $this->app['url']->route($route);
		if ($route) {
			$this->setAttribute('data-url', $route);
		}

		return $this;
	}

	/**
	 * Set the thumnail data attributes
	 *
	 * @param integer $width
	 * @param integer $height
	 * @param string  $class
	 *
	 * @return self
	 */
	public function thumbnail($width, $height = null, $class = null)
	{
		$this->setAttribute('data-thumbnail',       'true');
		$this->setAttribute('data-thumbnailwidth',  $width);
		$this->setAttribute('data-thumbnailheight', $height);
		$this->setAttribute('data-thumbnailclass',  $class);
	}

	/**
	 * Set the progress data attribute
	 *
	 * @param boolean $progress
	 *
	 * @return self
	 */
	public function progress($progress)
	{
		return $this->setDataAttribute('progress', $progress);
	}
}