<?php
require __DIR__.'/../vendor/autoload.php';

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Warkham\Facades\Warkham;

$app = Warkham::make();

// Routes
//////////////////////////////////////////////////////////////////////

// Define some routes for testing
$movies = function($query = null) {
	$movies  = include 'fixture-movies.php';
	$results = $query ? [] : $movies;
	foreach ($movies as $movie) {
		if (Str::contains(strtolower($movie), $query)) {
			$results[] = $movie;
		}
	}

	return Response::json($results)->send();
};

// Register the routes
$app['router']->get('movies', ['as' => 'movies', 'use' => $movies]);
$app['router']->get('oracle', ['as' => 'oracle', 'use' => $movies]);

// Request
//////////////////////////////////////////////////////////////////////

// Mock application handling
$request = $_SERVER['REQUEST_URI'];
$request = substr($request, strpos($request, '/public/') + 8);
if ($query = strpos($request, '?')) {
	$request = substr($request, 0, $query);
}

switch ($request) {
	case 'movies':
	case 'oracle':
		return $movies(array_get($_GET, 'q'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Warkham Test</title>
	<link rel="stylesheet" href="builds/css/warkham.css">
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
			<?= Warkham::oracle('oracle')->placeholder('Rechercher un film')->setRemoteRoute('movies')->setQueryMinLength(3)->setTemplate('<em style="color: red">{{value.id}} - {{value.text}}</em>') ?>
			<?= Warkham::choice('foo', 'Choice (list)')->setAvailableValues(['foo', 'bar'])->ui('list') ?>
			<?= Warkham::choice('foo', 'Choice (multiple)')->setAvailableValues(['foo', 'bar', 'baz', 'qux'])->ui('list')->multiple(true)->setMaxSelectionSize(2) ?>
			<?= Warkham::choice('foo', 'Choice (radio)')->setAvailableValues(['foo', 'bar'])->ui('radio') ?>
			<?= Warkham::choice('foo', 'Choice (checklist)')->setAvailableValues(['foo', 'bar'])->ui('checklist') ?>
			<?= Warkham::date('date') ?>
			<?= Warkham::taglist('taglist')->setTags(['foo', 'bar'])->setDataset(['baz', 'qux'])->setMaxSelectionSize(3) ?>
			<?= Warkham::taglist('taglist', 'Taglist (no create)')->setTags(['foo'])->setDataset(['baz', 'qux'])->setMaxSelectionSize(3)->allowCreate(false) ?>
		<?= Warkham::close() ?>
	</main>
	<script src="builds/js/warkham.js"></script>
</body>
</html>