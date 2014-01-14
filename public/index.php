<?php
require __DIR__.'/../vendor/autoload.php';

use Warkham\Facades\Warkham;
use Illuminate\Support\Facades\Response;

// Create application container for the demo here
$app = Warkham::make();

// Define some routes for testing
$oracle = function() {
	Response::json(array(
		1 => 'foo',
		2 => 'bar',
	))->send();
};

// Register the routes
$app['router']->get('oracle', ['as' => 'oracle', 'use' => $oracle]);

// Mock application handling
$request = $_SERVER['REQUEST_URI'];
$request = substr($request, strpos($request, '/public/') + 8);

switch ($request) {
	case 'oracle':
		return $oracle();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Warkham Test</title>
	<link rel="stylesheet" href="builds/css/warkham.min.css">
</head>
<body>
	<main class="container">
		<header class="page-title">
			<h1>Warkham</h1>
		</header>

		<?= Warkham::open() ?>
			<?= Warkham::text('text') ?>
			<?= Warkham::checkbox('checkbox') ?>
			<?= Warkham::file('file') ?>
			<?= Warkham::textarea('textarea') ?>
			<?= Warkham::oracle('oracle', 'Oracle (local)')->setRemoteRoute('oracle')->remote(false) ?>
			<?= Warkham::oracle('oracle', 'Oracle (remote)')->setRemoteRoute('oracle')->remote(true) ?>
			<?= Warkham::choice('foo', 'Choice (list)')->setAvailableValues(['foo', 'bar'])->ui('list') ?>
			<?= Warkham::choice('foo', 'Choice (radio)')->setAvailableValues(['foo', 'bar'])->ui('radio') ?>
			<?= Warkham::choice('foo', 'Choice (checklist)')->setAvailableValues(['foo', 'bar'])->ui('checklist') ?>
			<?= Warkham::date('date') ?>
		<?= Warkham::close() ?>
	</main>
	<script src="builds/js/warkham.min.js"></script>
</body>
</html>