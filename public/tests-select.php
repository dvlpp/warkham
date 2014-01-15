<?php

$movies = ["The Journey of the Fifth Horse (TV)","The Star Wagon (TV)","The Tiger Makes Out d'Arthur Hiller","Le Lauréat (The Graduate) de Mike Nichols","Un Dollaro per 7 vigliacchi (Madigan's Millions)","Sunday Father","Macadam Cowboy (Midnight Cowboy) de John Schlesinger","John et Mary (John and Mary) de Peter Yates","Little Big Man (Little Big Man) d'Arthur Penn","The Point (TV)","Qui est Harry Kellerman ? (Who IsHarry Kellerman and Why Is He Saying Those Terrible Things About Me?) de Ulu Grosbard","Les Chiens de paille (Straw Dogs) de Sam Peckinpah","Alfredo, Alfredo de Pietro Germi","Papillon de Franklin J. Schaffner","Lenny de Bob Fosse","Les Hommes du président (All the President's Men) de Alan J. Pakula","Marathon Man de John Schlesinger","Bette Midler","Le Récidiviste (Straight Time) d'Ulu Grosbard","Agatha de Michael Apted","Kramer contre Kramer (Kramer vs. Kramer) de Robert Benton","Tootsie de Sydney Pollack","Mort d'un commis voyageur (Death of a Salesman) de Volker Schlöndorff (TV)",
"Ishtar de Elaine May","Rain Man de Barry Levinson","Affaire de famille (Family Business) de Sidney Lumet","Dick Tracy de Warren Beatty","A Wish for Wings That Work (TV)","Billy Bathgate de Robert Benton","Hook ou la Revanche du Capitaine Crochet (Hook) de Steven Spielberg","Les Simpson (1 épisode","Héros malgré lui (Hero) de Stephen Frears","La Classe américaine, de Michel Hazanavicius et Dominique Mézerette","Alerte ! (Outbreak) de Wolfgang Petersen","American Buffalo","Sleepers de Barry Levinson","Mad City de Costa-Gavras","Des hommes d'influence (Wag the Dog) de Barry Levinson","Sphère (Sphere) de Barry Levinson","Jeanne d'Arc (The Messenger","Moonlight Mile de Brad Silberling","Confidence de James Foley","Le Maître du jeu (Runaway Jury) de Gary Fleder","Neverland (Finding Neverland) de Marc Forster","J'adore Huckabees (I Heart Huckabees) de David O. Russell","Les Désastreuses Aventures des orphelins Baudelaire (Lemony Snicket's A Series of Unfortunate Events) de Brad Silberling","Mon beau-père, mes parents et moi (Meet the Fockers) de Jay Roach","Zig Zag, l'étalon zébré (Racing Stripes) de Frederik Du Chau","Adieu Cuba (The Lost City) d'Andy García","Le Parfum, histoire d'un meurtrier (Perfume","L'Incroyable Destin de Harold Crick (Stranger Than Fiction) de Marc Forster","The Holiday de Nancy Meyers","Kung Fu Panda","Le Merveilleux Magasin de Mr. Magorium de Zach Helm","La Légende de Despereaux de Sam Fell","Last Chance for Love de Joel Hopkins",
"Mon beau-père et nous (Little Fockers) de Paul Weitz","Kung Fu Panda 2","Le Monde de Barney de Richard J. Lewis"];

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
		echo json_encode(array("Rain Man de Barry Levinson", "Des hommes d'influence (Wag the Dog) de Barry Levinson")); die();
	case 'search_films':
		$results = array();
		foreach($movies as $m) {
			if(strpos($m, $params["q"]) !== false) $results[] = $m;
		}
		echo json_encode($results); die();
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
				<? $k=1 ?>
				<? foreach($movies as $m): ?>
					<option value="<?=$k++?>"><?=$m?></option>
				<? endforeach ?>
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
		$(document).ready(function() {
			$('#autocomplete').typeahead({
				name: 'movies',
				prefetch: 'tests-select.php/prefetch_films',
				remote: 'tests-select.php/search_films?q=%QUERY'
			});
			
			$("#choice").select2();
			
			$("#oracle").select2({
			    placeholder: "Rechercher un film de Dustin Hoffmann",
			    minimumInputLength: 1,
			    ajax: {
			        url: "tests-select.php/search_films",
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
		});
	</script>
	
</body>
</html>