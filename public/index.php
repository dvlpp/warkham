<?php
require __DIR__.'/../vendor/autoload.php';
use Warkham\Facades\Warkham;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Warkham Test</title>
	<link rel="stylesheet" href="warkham.min.css">
</head>
<body>
	<main class="container">
		<header class="page-title">
			<h1>Warkham</h1>
		</header>

		<?= Warkham::open() ?>
			<?= Warkham::text('foo') ?>
		<?= Warkham::close() ?>
	</main>
	<script src="warkham.min.js"></script>
</body>
</html>