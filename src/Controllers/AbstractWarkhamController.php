<?php
namespace Warkham\Traits;

use Illuminate\Routing\Controller;

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
		$destination = App::make('path.public').'/uploads';

		// Loop over uploads and move them to their destination
		foreach ($uploads as $upload) {
			$upload->move($destination);
		}
	}
}