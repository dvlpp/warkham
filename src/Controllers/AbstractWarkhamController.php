<?php
namespace Warkham\Controllers;

use App;
use Illuminate\Routing\Controller;
use Input;

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
}