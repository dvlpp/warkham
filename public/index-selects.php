<?php
require __DIR__.'/../vendor/autoload.php';
use Illuminate\Support\Facades\Response;

$movies = include 'fixture-movies.php';

// Mock application handling
$request = $_SERVER['REQUEST_URI'];
$request = substr($request, strrpos($request, '/') + 1);
if(strpos($request, "?")) {
	list($request, $allparams) = explode("?", $request);
	$allparams = explode("&", $allparams);
	$params = array();
	foreach($allparams as $p) {
		list($id, $val) = explode("=", $p);
		$params[$id] = $val;
	}
}

switch ($request) {
	case 'prefetch_films':
		return Response::json(array("Rain Man de Barry Levinson", "Des hommes d'influence (Wag the Dog) de Barry Levinson"))->send();

	case 'search_films':
		$results = array();
		foreach($movies as $m) {
			if(strpos($m, $params["q"]) !== false) $results[] = $m;
		}
		return Response::json($results)->send();
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

		<div class="row">
			<div class="form-group">
				<label>Warkham::autocomplete</label>
				<input type="text" name="autocomplete" id="autocomplete" class="form-control">
				<p class="help-block">Chargement distant + prefetch optionnel ; donnée renvoyée en tant que text ; possibilité d'entrer un texte libre</p>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Warkham::choice [ui=list, multiple=false]</label>
				<select id="choice">
				<?php $k=1 ?>
				<?php foreach($movies as $m): ?>
					<option value="<?= $k++ ?>"><?= $m ?></option>
				<?php endforeach ?>
				</select>
				<p class="help-block">Chargement local ; donnée renvoyée en tant qu'ID ; pas de création possible</p>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Warkham::oracle</label>
				<input type="text" id="oracle">
				<p class="help-block">Chargement distant ; donnée renvoyée en tant qu'ID ; pas de création possible</p>
			</div>
		</div>

	</main>

	<script src="builds/js/warkham.min.js"></script>
	<script>
		$('#autocomplete').typeahead({
			name     : 'movies',
			prefetch : 'index-selects.php/prefetch_films',
			remote   : 'index-selects.php/search_films?q=%QUERY'
		});

		$("#choice").select2();

		$("#oracle").select2({
			placeholder: "Rechercher un film de Dustin Hoffmann",
			minimumInputLength: 1,
			ajax: {
				url: "index-selects.php/search_films",
				dataType: 'json',
				data: function (term, page) {
					return {
						q: term,
						page_limit: 10
					};
				},
				results: function (data, page) {
					var tt = new Array();
					for(k=0; k<data.length; k++) {
						var t = {};
						t.id = k+1;
						t.text = data[k];
						tt.push(t);
					}
					return {results: tt};
				}
			}
		});
	</script>

</body>
</html>