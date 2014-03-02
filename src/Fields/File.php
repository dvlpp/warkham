<?php
namespace Warkham\Fields;

use HtmlObject\Element;
use Former\Form\Fields\File as FormerFile;
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

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

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
		return $this->setRoute($route);
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

		return $this;
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

	////////////////////////////////////////////////////////////////////
	///////////////////////////// RENDERING ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Render the input
	 *
	 * @return string
	 */
	public function render()
	{
		$input = parent::render();
		$image = $this->getAttribute('data-thumbnail') == 'true';

		$thumbnail = '';
		if ($image) {
			$thumbnail = '<div class="wkm-file-preview"></div>';
		}

		// Browse button
		$browse = Element::create('div')->addClass('js-browse')
			->nest('<span class="btn-txt">Browse</span>')
			->nest($input);

		// Progress
		$progress = Element::create('div')->class('js-upload')->style('display: none')
			->nest('<div class="progress progress-primary">'.
					'<div class="js-progress bar"></div>'.
				'</div>'.
				'<span class="btn-txt">Uploading (<span class="js-size"></span>)</span>');

		// Wrapper
		$wrapper = Element::create('div')->addClass('btn btn-info wkm-file-wrapper')
			->nest($thumbnail)
			->nest($browse)
			->nest($progress);

		if ($image) {
			$wrapper = Element::create('div')->class('wkm-file-wrapper--preview')->nest($wrapper);
		}

		return $wrapper->render();
	}
}
