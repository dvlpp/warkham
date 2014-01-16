<?php
require __DIR__.'/../vendor/autoload.php';

use Illuminate\Support\Facades\Response;
use Warkham\Facades\Warkham;

$app = Warkham::make();

// Routes
//////////////////////////////////////////////////////////////////////

// Define some routes for testing
$movies = function() {
	return Response::json(include 'fixture-movies.php')->send();
};

// Register the routes
$app['router']->get('movies', ['as' => 'movies', 'use' => $movies]);
$app['router']->get('oracle', ['as' => 'oracle', 'use' => $movies]);

// Request
//////////////////////////////////////////////////////////////////////

// Mock application handling
$request = $_SERVER['REQUEST_URI'];
$request = substr($request, strpos($request, '/public/') + 8);

switch ($request) {
	case 'movies':
	case 'oracle':
		return $movies();
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
			<?= Warkham::autocomplete('autocomplete')->setDataset(['foo', 'bar'])->setRemoteRoute('movies')->setTemplate('<em style="color: YellowGreen">{{value}}</em>') ?>
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