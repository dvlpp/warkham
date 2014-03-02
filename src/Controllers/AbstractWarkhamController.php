<?php
namespace Warkham\Controllers;

use App;
use Illuminate\Routing\Controller;
use Input;
use Intervention\Image\Image;

/**
 * A Warkham controller
 */
abstract class AbstractWarkhamController extends Controller
{
	/**
	 * Move the various files bound to an input and upload them
	 *
	 * @param string $field
	 * @param string $destination
	 *
	 * @return void
	 */
	public function moveUploads($field, $destination)
	{
		$uploads     = (array) Input::file($field);
		$destination = 'uploads/'.$destination;

		// Loop over uploads and move them to their destination
		foreach ($uploads as $upload) {
			$name  = md5_file($upload->getRealpath());
			$name .= '.'.$upload->getClientOriginalExtension();

			$upload->move($destination, $name);
		}
	}

	/**
	 * Resize an image
	 *
	 * @param string  $image
	 * @param integer $width
	 * @param integer $height
	 *
	 * @return Image
	 */
	public function resizeImage($image, $width, $height)
	{
		$image = Image::make('public/'.$image);
		$image->resize($width, $height);
		$image->save();

		return $image;
	}
}